<?php
namespace Stef\CurrencyServiceBundle\ApiFactory;

use Stef\CurrencyServiceBundle\ApiConnectors\ConnectorInterface;
use Stef\CurrencyServiceBundle\ApiConnectors\CurrencyConverterKowabungaConnector;
use Stef\CurrencyServiceBundle\ApiConnectors\JsonratesConnector;
use Stef\CurrencyServiceBundle\ApiConnectors\WebservicexConnector;

class Factory
{
    /**
     * @param $service
     *
     * @return ConnectorInterface
     */
    public function getConverter($service)
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

        if ($service === 'jsonrates') {
            $converter = new JsonratesConnector('http://jsonrates.com/get/');

            return $converter;
        }

        return null;
    }
}