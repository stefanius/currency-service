<?php

namespace Stef\CurrencyServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('StefCurrencyServiceBundle:Default:index.html.twig', array('name' => $name));
    }
}
