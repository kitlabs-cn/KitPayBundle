<?php

namespace Kit\Bundle\PayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KitPayBundle:Default:index.html.twig');
    }
}
