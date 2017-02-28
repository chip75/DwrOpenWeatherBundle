<?php

namespace Dwr\OpenWeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/weather-basic-small")
     */
    public function indexAction()
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
}
