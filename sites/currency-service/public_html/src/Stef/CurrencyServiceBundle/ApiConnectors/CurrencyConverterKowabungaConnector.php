<?php
namespace Stef\CurrencyServiceBundle\ApiConnectors;

class CurrencyConverterKowabungaConnector extends AbstractSoapConnector
{
    public function getExchange($currencyFrom, $currencyTo)
    {
        /*
        $params = [
            'CurrencyFrom' => $currencyFrom,
            'CurrencyTo'   => $currencyTo,
            'RateDate'     => '04-25-2015'
        ];

        $result = $this->client->__soapCall('GetConversionRate', [$params]);

        return $result->GetConversionRateResult;
        */

        return 1;
    }

    /**
     * @inheritdoc
     */
    public function getSupportedCurrencies()
    {
        $result = $this->client->__soapCall('GetCurrencies', [[]]);

        $rawCurrencies = $result->GetCurrenciesResult->string;

        $currencies = [];

        foreach ($rawCurrencies as $currency) {
            $currencies[$currency] = $currency;
        }

        return $currencies;
    }
}