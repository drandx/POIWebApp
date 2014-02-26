<?php

namespace Interactive\POIWebAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('POIWebAppBundle:Default:index.html.twig', array('name' => $name));
    }
}
