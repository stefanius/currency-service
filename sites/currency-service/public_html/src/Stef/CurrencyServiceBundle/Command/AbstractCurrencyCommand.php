<?php

namespace Stef\CurrencyServiceBundle\Command;

use Stef\CurrencyServiceBundle\ApiFactory\Factory;
use Stef\CurrencyServiceBundle\Manager\AbstractOptionsManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

abstract class AbstractCurrencyCommand extends ContainerAwareCommand
{
    protected function get($service)
    {
        return $this->getApplication()->getKernel()->getContainer()->get($service);
    }

    /**
     * @return Factory
     */
    protected function getConverterFactory()
    {
        return $this->get('stef_currency_converter.factory_service');
    }

    /**
     * @param $service
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
     * @return \Stef\CurrencyServiceBundle\ApiConnectors\ConnectorInterface
     * @throws \Exception
     */
    protected function getConverter($service)
    {
        $factory = $this->getConverterFactory();

        $converter = $factory->getConverter($service);

        if ($converter == null) {
            throw new \Exception('Sorry, you used a wrong service.');
        }

        return $converter;
    }
}