<?php
namespace Stef\CurrencyServiceBundle\ApiConnectors;

interface ConnectorInterface
{
    /**
     * Get the exchange ('wisselkoers' in Dutch) between two currency's
     *
     * @param $currencyFrom
     * @param $currencyTo
     *
     * @return double
     */
    public function getExchange($currencyFrom, $currencyTo);

    /**
     * Get the calculated amount of the currency
     *
     * @param $currencyFrom
     * @param $currencyTo
     * @param $amount
     *
     * @return double
     */
    public function getCalculatedAmount($currencyFrom, $currencyTo, $amount);
}