<?php

namespace Stef\CurrencyServiceBundle\Manager;

use Stef\CurrencyServiceBundle\Entity\JsonratesOptions;
use Symfony\Component\HttpFoundation\ParameterBag;

class JsonratesOptionsManager extends AbstractOptionsManager
{
    protected $repoName = 'StefCurrencyServiceBundle:JsonratesOptions';

    /**
     * @param ParameterBag $data
     *
     * @return JsonratesOptions
     */
    public function create(ParameterBag $data)
    {
        $options = new JsonratesOptions();

        $options->setCurrencyDisplayName($data->get('currency_display_name'));
        $options->setCurrencyServiceCode($data->get('currency_service_code'));

        return $options;
    }
}