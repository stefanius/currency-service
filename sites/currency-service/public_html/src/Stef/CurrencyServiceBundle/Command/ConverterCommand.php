<?php
namespace Stef\CurrencyServiceBundle\Command;

use Stef\CurrencyServiceBundle\ApiConnectors\CurrencyConverterKowabungaConnector;
use Stef\CurrencyServiceBundle\ApiConnectors\WebservicexConnector;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConverterCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('currency:convert')
            ->setDescription('Convert Locationdata in our own format.')
            ->addArgument(
                'service',
                InputArgument::REQUIRED,
                'Which service do you want to use? "kowabunga" or "webservicex."'
            )
            ->addArgument(
                'from',
                InputArgument::REQUIRED,
                'currency type FROM'
            )
            ->addArgument(
                'to',
                InputArgument::REQUIRED,
                'currency type TO'
            )
            ->addArgument(
                'amount',
                InputArgument::OPTIONAL,
                'The total amount of the currency to convert'
            )
        ;
    }

    protected function get($service)
    {
        return $this->getApplication()->getKernel()->getContainer()->get($service);
    }

    protected function getConverter($service)
    {
        if ($service === 'kowabunga') {
            $client = new \SoapClient('http://currencyconverter.kowabunga.net/converter.asmx?WSDL');
            $converter = new CurrencyConverterKowabungaConnector($client);

            return $converter;
        }

        if ($service === 'webservicex') {
            $client = new \SoapClient('http://www.webservicex.net/currencyconvertor.asmx?WSDL');
            $converter = new WebservicexConnector($client);

            return $converter;
        }

        throw new \Exception('Sorry, you used a wrong service.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $service = $input->getArgument('service');
        $from = strtoupper($input->getArgument('from'));
        $to = strtoupper($input->getArgument('to'));
        $amount = $input->getArgument('amount');

        $converter = $this->getConverter($service);

        $exchange = $converter->getExchange($from, $to);

        $output->writeln('Exchange information. Converting ' . $from . ' to ' . $to);
        $output->writeln('You choosed to use service: "' . $service .'"');
        $output->writeln('One ' . $from . ' is ' . $exchange . ' ' . $to);

        if ($amount != null) {
            $calculated = $converter->getCalculatedAmount($from, $to, $amount);

            $output->writeln('The value of ' . $amount . ' ' . $from . ' is the same as ' . $calculated . ' ' . $to . '. (rounded)');
        }
    }


}