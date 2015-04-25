<?php
namespace Stef\CurrencyServiceBundle\ApiConnectors;

class WebservicexConnector extends AbstractConnector
{
    /**
     * @inheritdoc
     */
    public function getExchange($currencyFrom, $currencyTo)
    {
        $params = [
            'FromCurrency' => $currencyFrom,
            'ToCurrency'   => $currencyTo
        ];

        $result = $this->client->__soapCall('ConversionRate', [$params]);

        return $result->ConversionRateResult;
    }
}