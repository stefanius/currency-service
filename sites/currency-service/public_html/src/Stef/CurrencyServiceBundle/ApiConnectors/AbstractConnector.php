<?php
namespace Stef\CurrencyServiceBundle\ApiConnectors;

abstract class AbstractConnector implements ConnectorInterface
{
    /**
     * @var \SoapClient
     */
    protected $client;

    function __construct(\SoapClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get the calculated amount of the currency
     *
     * @param $currencyFrom
     * @param $currencyTo
     * @param $amount
     *
     * @return double
     */
    public function getCalculatedAmount($currencyFrom, $currencyTo, $amount)
    {
        $exchange = $this->getExchange($currencyFrom, $currencyTo);

        $calculated = $amount * $exchange;

        return number_format($calculated, 2, '.', '') ;
    }
}