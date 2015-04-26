<?php
namespace Stef\CurrencyServiceBundle\Command;

use Stef\CurrencyServiceBundle\ApiConnectors\CurrencyConverterKowabungaConnector;
use Stef\CurrencyServiceBundle\ApiConnectors\WebservicexConnector;
use Stef\CurrencyServiceBundle\ApiFactory\Factory;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class SupportedCommand extends AbstractCurrencyCommand
{
    protected function configure()
    {
        $this
            ->setName('currency:supported')
            ->setDescription('Convert Locationdata in our own format.')
            ->addArgument(
                'service',
                InputArgument::REQUIRED,
                'Which service do you want to use? "kowabunga" or "webservicex."'
            )
            ->addArgument(
                'save',
                InputArgument::OPTIONAL,
                'boolean TRUE: Saves the data in the CMS. FALSE: Display only on CLI (default)',
                false
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $service = $input->getArgument('service');
        $save = $input->getArgument('save');

        if (!is_bool($save)){
            $save = ($save === 'true' || $save === '1');
        }

        $manager = $this->getOptionsManager($service);
        $converter = $this->getConverter($service);

        $supportedCurrencies = $converter->getSupportedCurrencies();

        $output->writeln("Supported currencies for " . $service);

        foreach ($supportedCurrencies as $key => $value) {
            $output->writeln("CurrencyCode: " . $key . "; CurrencyName: " . $value);

            if ($save && $manager != null) {
                $data = new ParameterBag([
                    'currency_service_code' => $key,
                    'currency_display_name' => $value,
                ]);

                $entity = $manager->create($data);
                $manager->persistAndFlush($entity);
            }
        }
    }
}