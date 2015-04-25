<?php
namespace Stef\CurrencyServiceBundle\Command;

use Stef\CurrencyServiceBundle\ApiConnectors\CurrencyConverterKowabungaConnector;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConverterCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('currency:convert')
            ->setDescription('Convert Locationdata in our own format.')
        ;
    }

    protected function get($service)
    {
        return $this->getApplication()->getKernel()->getContainer()->get($service);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new \SoapClient('http://currencyconverter.kowabunga.net/converter.asmx?WSDL');

        $converter = new CurrencyConverterKowabungaConnector($client);

        $converter->getExchange('EUR', 'USD');
    }
}