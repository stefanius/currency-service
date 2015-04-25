<?php
namespace Stef\CurrencyServiceBundle\ApiConnectors;

class CurrencyConverterKowabungaConnector extends AbstractConnector
{
    /**
     * @var \SoapClient
     */
    protected $client;

    function __construct(\SoapClient $client)
    {
        $this->client = $client;
    }

    function getExchange($currencyFrom, $currencyTo)
    {
        $result = $this->client->__soapCall('GetConversionRate', [
            'CurrencyFrom' => $currencyFrom,
            'CurrencyTo' => $currencyTo,
            'RateDate' => '04-25-2015'
        ]);

        return $result;
    }
}