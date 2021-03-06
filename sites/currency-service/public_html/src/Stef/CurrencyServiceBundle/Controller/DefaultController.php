<?php

namespace Stef\CurrencyServiceBundle\Controller;

use Stef\CurrencyServiceBundle\Form\ConvertType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    public function convertAction(Request $request, $service)
    {
        $choices = $this->getChoices($service);
        $convertType = new ConvertType($choices);
        $form = $this->createForm($convertType);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $data = $form->getData();
                $converter = $this->loadConverter($service);

                return $this->render('StefCurrencyServiceBundle:Default:convert.html.twig', [
                    'form' => $form->createView(),
                    'exchange' => $converter->getExchange($data['from'], $data['to']),
                    'calculated' => $converter->getCalculatedAmount($data['from'], $data['to'], $data['amount']),
                ]);
            }
        }

        return $this->render('StefCurrencyServiceBundle:Default:convert.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function indexAction()
    {
        return $this->render('StefCurrencyServiceBundle:Default:index.html.twig');
    }
}
