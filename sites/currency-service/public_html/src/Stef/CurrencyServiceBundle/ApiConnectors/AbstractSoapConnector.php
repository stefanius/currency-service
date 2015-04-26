<?php

namespace Stef\CurrencyServiceBundle\ApiConnectors;


abstract class AbstractSoapConnector extends AbstractConnector
{
    /**
     * @var \SoapClient
     */
    protected $client;

    function __construct(\SoapClient $client)
    {
        $this->client = $client;
    }
}