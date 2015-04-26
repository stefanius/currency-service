<?php

namespace Stef\CurrencyServiceBundle\Controller;

use Stef\CurrencyServiceBundle\ApiConnectors\ConnectorInterface;
use Stef\CurrencyServiceBundle\ApiConnectors\CurrencyConverterKowabungaConnector;
use Stef\CurrencyServiceBundle\ApiConnectors\WebservicexConnector;
use Stef\CurrencyServiceBundle\ApiFactory\Factory;
use Stef\CurrencyServiceBundle\Entity\AbstractServiceOptionsEntity;
use Stef\CurrencyServiceBundle\Manager\AbstractOptionsManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    /**
     * @return Factory
     */
    public function getConverterFactory()
    {
        return $this->get('stef_currency_converter.factory_service');
    }

    /**
     * @param $service
     * 
     * @return ConnectorInterface
     */
    protected function loadConverter($service)
    {
        $factory = $this->getConverterFactory();

        return $factory->getConverter($service);
    }

    /**
     * @param $service
     *
     * @@return AbstractOptionsManager
     */
    protected function getOptionsManager($service)
    {
        if ($service === 'kowabunga') {
            return $this->get('stef_simple_cms.currency_converter_manager');
        }

        if ($service === 'webservicex') {
            return $this->get('stef_simple_cms.webservicex_manager');
        }

        if ($service === 'jsonrates') {
            return $this->get('stef_simple_cms.jsonrates_manager');
        }

        return null;
    }

    /**
     * @param $service
     *
     * @return array
     */
    protected function getChoices($service)
    {
        $manager = $this->getOptionsManager($service);
        $choices = [];

        if ($manager == null) {
            return [];
        }

        $list = $manager->getAllRecords();

        /**
         * @var AbstractServiceOptionsEntity $item
         */
        foreach ($list as $item) {
            $choices[$item->getCurrencyServiceCode()] = $item->getCurrencyDisplayName();
        }

        return $choices;
    }
}