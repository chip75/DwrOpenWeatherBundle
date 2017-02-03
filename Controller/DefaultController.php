<?php

namespace Dwr\GlobalWeatherBundle\Controller;

use Dwr\GlobalWeatherBundle\Entity\Location;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/globalweather")
     *
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $weather  = null;
        $location = new Location();

        $form = $this->createForm(
            $this->get('dwr_global_weather_form_type'),
            $location
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $globalWeather = $this->get('dwr_global_weather');
            $weather = $globalWeather->getCurrentWeather($location);
        }

        return $this->render('DwrGlobalWeatherBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            'weather' => $weather
        ));
    }
}
