<?php
namespace Stef\CurrencyServiceBundle\ApiConnectors;

class CurrencyConverterKowabungaConnector extends AbstractConnector
{
    public function getExchange($currencyFrom, $currencyTo)
    {
        $params = [
            'CurrencyFrom' => $currencyFrom,
            'CurrencyTo'   => $currencyTo,
            'RateDate'     => '04-25-2015'
        ];

        $result = $this->client->__soapCall('GetConversionRate', [$params]);

        return $result->GetConversionRateResult;
    }
}