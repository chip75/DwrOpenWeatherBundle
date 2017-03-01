<?php

namespace Dwr\OpenWeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Dwr\OpenWeatherBundle\Utility\Converter;

class DefaultController extends Controller
{
    /**
     * @Route("/weather-basic-small")
     */
    public function weatherBasicSmallAction()
    {
        $openWeather = $this->get('dwr_open_weather');
        $weather = $openWeather->setType('Weather')->getByCityName('London');

        return $this->render('DwrOpenWeatherBundle:Default:index.html.twig', array(
            'weather' => $weather,
        ));
    }

    /**
     * @Route("/weather-basic-medium")
     */
    public function weatherBasicMediumAction()
    {
        $openWeather = $this->get('dwr_open_weather');
        $weather = $openWeather->setType('Weather')->getByCityName('New York');

        return $this->render('DwrOpenWeatherBundle:Default:weather-basic-medium.html.twig', array(
            'weather' => $weather,
        ));
    }

    /**
     * @Route("/weather-basic-large")
     */
    public function weatherBasicLargeAction()
    {
        $openWeather = $this->get('dwr_open_weather');
        $weather = $openWeather->setType('Weather')->getByCityName('Beijing');

        return $this->render('DwrOpenWeatherBundle:Default:weather-basic-large.html.twig', array(
            'weather' => $weather,
        ));
    }

    /**
     * @Route("/forecast-basic")
     */
    public function forecastBasicAction()
    {
        $openWeather = $this->get('dwr_open_weather');
        $forecastCity = $openWeather->setType('Forecast')->getByCityName('Rome');

        $forecast = array_map(function ($value) {
            return [
                'timestamp' => $value['dt'],
                'temp' => $value['main']['temp'],
                'pressure' => $value['main']['pressure'],
                'humidity' => $value['main']['humidity'],
                'description' => ($value['weather'][0]['description'])?$value['weather'][0]['description']:'',
                'icon' => ($value['weather'][0]['icon'])?$value['weather'][0]['icon']:'',
            ];
        }, $forecastCity->lists());

        return $this->render('DwrOpenWeatherBundle:Default:forecast-basic.html.twig', array(
            'forecast' => $forecast,
        ));
    }

    /**
     * @Route("/forecast-chart")
     */
    public function forecastChartAction()
    {
        $openWeather = $this->get('dwr_open_weather');

        $city1 = 'Warsaw';
        $forecastCity1 = $openWeather->setType('Forecast')->getByCityName($city1);
        $forecastCity1Labels = json_encode(array_map(function ($value) {
            return Converter::intToDate($value['dt'], 'd-m-Y H:i');
        }, $forecastCity1->lists()));
        $forecastCity1Temps = json_encode(array_map(function ($value) {
            return Converter::kelvinToCelsius($value['main']['temp']);
        }, $forecastCity1->lists()));

        $city2 = 'Berlin';
        $forecastCity2 = $openWeather->setType('Forecast')->getByCityName($city2);
        $forecastCity2Labels = json_encode(array_map(function ($value) {
            return Converter::intToDate($value['dt'], 'd-m-Y H:i');
        }, $forecastCity2->lists()));
        $forecastCity2Temps = json_encode(array_map(function ($value) {
            return Converter::kelvinToCelsius($value['main']['temp']);
        }, $forecastCity2->lists()));

        $city3 = 'London';
        $forecastCity3 = $openWeather->setType('Forecast')->getByCityName($city3);
        $forecastCity3Labels = json_encode(array_map(function ($value) {
            return Converter::intToDate($value['dt'], 'd-m-Y H:i');
        }, $forecastCity3->lists()));
        $forecastCity3Temps = json_encode(array_map(function ($value) {
            return Converter::kelvinToCelsius($value['main']['temp']);
        }, $forecastCity3->lists()));

        return $this->render('DwrOpenWeatherBundle:Default:forecast-chart.html.twig', array(
            'city1' => $city1,
            'forecastCity1' => $forecastCity1,
            'forecastCity1Temps' => $forecastCity1Temps,
            'forecastCity1Labels' => $forecastCity1Labels,

            'city2' => $city2,
            'forecastCity2' => $forecastCity2,
            'forecastCity2Temps' => $forecastCity2Temps,
            'forecastCity2Labels' => $forecastCity2Labels,

            'city3' => $city3,
            'forecastCity3' => $forecastCity3,
            'forecastCity3Temps' => $forecastCity3Temps,
            'forecastCity3Labels' => $forecastCity3Labels,
        ));
    }
}
