<?php

namespace Project\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjectVideoBundle:Default:index.html.twig');
    }
}
