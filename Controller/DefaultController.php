<?php

namespace Dwr\GlobalWeatherBundle\Controller;

use Dwr\GlobalWeatherBundle\Entity\Location;
use Dwr\GlobalWeatherBundle\Form\GlobalWeatherType;
use Dwr\GlobalWeatherBundle\Form\LocationChoice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/globalweather")
     */
    public function indexAction(Request $request)
    {
        $location = new Location();
        $form = $this->createForm(new GlobalWeatherType(), $location);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            die(__FILE__.'\\'.__LINE__);
        }

        return $this->render('DwrGlobalWeatherBundle:Default:index.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
