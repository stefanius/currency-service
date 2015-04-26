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

    protected function curl($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}