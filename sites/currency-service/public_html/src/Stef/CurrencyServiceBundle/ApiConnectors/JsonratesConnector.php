<?php
namespace Stef\CurrencyServiceBundle\ApiConnectors;

class JsonratesConnector extends AbstractJsonConnector
{
    protected $apiKey = 'jr-d235b4bf2cf4e0230b6d222c2016f2c4';
    /**
     * @inheritdoc
     */
    public function getExchange($currencyFrom, $currencyTo)
    {
        $data = file_get_contents('http://jsonrates.com/get/?from=' . $currencyFrom . '&to=' . $currencyTo . '&apiKey=' . $this->apiKey);
        $json = json_decode($data);
        $rate = (float) $json->rate;

        return $rate;
    }

    /**
     * @inheritdoc
     */
    public function getSupportedCurrencies()
    {
        return [
            'USD' => 'USD',
            'EUR' => 'EUR',
        ];
    }
}