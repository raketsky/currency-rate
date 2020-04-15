<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchCurrenciesCommand extends Command
{
    protected static $defaultName = 'bank:fetch-currencies';

    protected function configure()
    {
        $this->setDescription('Obtains currency data from bank.lv for two days');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('Fetching..');
        $output->writeln('DONE');

        return 0;
    }
}