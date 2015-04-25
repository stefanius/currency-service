<?php

namespace Stef\CurrencyServiceBundle\Controller;

use Stef\CurrencyServiceBundle\ApiConnectors\ConnectorInterface;
use Stef\CurrencyServiceBundle\ApiConnectors\CurrencyConverterKowabungaConnector;
use Stef\CurrencyServiceBundle\ApiConnectors\WebservicexConnector;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    /**
     * @param $service
     * 
     * @return ConnectorInterface
     */
    protected function loadConverter($service)
    {
        if ($service === 'kowabunga') {
            $client = new \SoapClient('http://currencyconverter.kowabunga.net/converter.asmx?WSDL');
            $converter = new CurrencyConverterKowabungaConnector($client);

            return $converter;
        }

        if ($service === 'webservicex') {
            $client = new \SoapClient('http://www.webservicex.net/currencyconvertor.asmx?WSDL');
            $converter = new WebservicexConnector($client);

            return $converter;
        }
    }
}