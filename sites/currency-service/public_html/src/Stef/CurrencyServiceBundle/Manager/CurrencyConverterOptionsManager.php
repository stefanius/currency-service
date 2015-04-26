<?php

namespace Stef\CurrencyServiceBundle\Manager;

use Stef\CurrencyServiceBundle\Entity\CurrencyConverterOptions;
use Symfony\Component\HttpFoundation\ParameterBag;

class CurrencyConverterOptionsManager extends AbstractOptionsManager
{
    protected $repoName = 'StefCurrencyServiceBundle:CurrencyConverterOptions';

    /**
     * @param ParameterBag $data
     *
     * @return CurrencyConverterOptions
     */
    public function create(ParameterBag $data)
    {
        $options = new CurrencyConverterOptions();

        $options->setCurrencyDisplayName($data->get('currency_display_name'));
        $options->setCurrencyServiceCode($data->get('currency_service_code'));

        return $options;
    }
}