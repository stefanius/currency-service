<?php

namespace Stef\CurrencyServiceBundle\Controller;

use Stef\CurrencyServiceBundle\ApiConnectors\ConnectorInterface;
use Stef\CurrencyServiceBundle\ApiConnectors\CurrencyConverterKowabungaConnector;
use Stef\CurrencyServiceBundle\ApiConnectors\WebservicexConnector;
use Stef\CurrencyServiceBundle\ApiFactory\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    /**
     * @return Factory
     */
    public function getConverterFactory()
    {
        return $this->get('stef_currency_converter.factory_service');
    }

    /**
     * @param $service
     * 
     * @return ConnectorInterface
     */
    protected function loadConverter($service)
    {
        $factory = $this->getConverterFactory();

        return $factory->getConverter($service);
    }
}