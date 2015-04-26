<?php

namespace Stef\CurrencyServiceBundle\ApiConnectors;

abstract class AbstractJsonConnector extends AbstractConnector
{
    protected $url;

    function __construct($url)
    {
        $this->url = $url;
    }
}