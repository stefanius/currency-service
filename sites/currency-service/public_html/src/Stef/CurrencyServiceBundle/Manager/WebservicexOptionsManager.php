<?php

namespace Stef\CurrencyServiceBundle\Manager;

use Stef\CurrencyServiceBundle\Entity\WebservicexOptions;
use Symfony\Component\HttpFoundation\ParameterBag;

class WebservicexOptionsManager extends AbstractOptionsManager
{
    protected $repoName = 'StefCurrencyServiceBundle:WebservicexOptions';

    /**
     * @param ParameterBag $data
     *
     * @return WebservicexOptions
     */
    public function create(ParameterBag $data)
    {
        $options = new WebservicexOptions();

        $options->setCurrencyDisplayName($data->get('currency_display_name'));
        $options->setCurrencyServiceCode($data->get('currency_service_code'));

        return $options;
    }
}