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
            'weather' => $weather
        ));
    }
}
