<?php
namespace App\Command;

use App\Service\BankService;
use App\Service\CurrencyService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchCurrenciesCommand extends Command
{
    protected static $defaultName = 'bank:fetch-currencies';

    /**
     * @var CurrencyService
     */
    private $currencyService;

    /**
     * @var BankService
     */
    private $bankService;

    public function __construct(
        CurrencyService $currencyService,
        BankService $bankService
    ) {
        parent::__construct();

        $this->currencyService = $currencyService;
        $this->bankService = $bankService;
    }

    protected function configure(): void
    {
        $this->setDescription('Obtains currency data from bank.lv for two days');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->write('Fetching..');

        $daysFromBank = $this->bankService->getData();
        foreach ($daysFromBank as $dayFromBank) {
            $this->currencyService->addByDateBatch($dayFromBank['date'], $dayFromBank['items']);
        }

        $output->writeln('DONE');

        return 0;
    }
}
