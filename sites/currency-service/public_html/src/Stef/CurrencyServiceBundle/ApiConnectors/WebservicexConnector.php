<?php
namespace Stef\CurrencyServiceBundle\ApiConnectors;

class WebservicexConnector extends AbstractSoapConnector
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

    /**
     * @inheritdoc
     */
    public function getSupportedCurrencies()
    {
        $response = $this->curl('http://www.webservicex.net/currencyconvertor.asmx');

        preg_match_all('/<blockquote>(.*?)blockquote>/i', $response, $result);

        $result = str_replace("<p><font face='Verdana' size='1'>", '', $result[1][0]);
        $result = str_replace("</font></p></", '', $result);
        $result = str_replace("&amp;amp;", '&', $result);

        $rawCurrencies = explode('<br>', $result);

        $currencies = [];

        foreach ($rawCurrencies as $currencie) {
            $value = explode('-', $currencie);
            $currencies[$value[0]] = $value[1];
        }

        return $currencies;
    }
}