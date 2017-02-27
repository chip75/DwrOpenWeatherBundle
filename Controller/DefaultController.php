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
        $openWeather->setType('Weather');

        return $this->render('DwrOpenWeatherBundle:Default:index.html.twig', array(
            'weather' => $openWeather->getByCityName('London')
        ));
    }
}
