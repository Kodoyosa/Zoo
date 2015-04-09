<?php

namespace Kodo\ZooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KodoZooBundle:Default:index.html.twig');
    }
}
