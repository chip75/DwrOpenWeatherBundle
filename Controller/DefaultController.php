<?php

namespace Dwr\GlobalWeatherBundle\Controller;

use Dwr\GlobalWeatherBundle\Entity\Location;
use Dwr\GlobalWeatherBundle\Form\GlobalWeatherType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/dwr-global-weather")
     *
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $weather = null;

        $location = new Location();
        $form = $this->createForm(new GlobalWeatherType(), $location);

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
