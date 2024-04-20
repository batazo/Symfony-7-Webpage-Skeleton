<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:check-database-connection')]
class CheckDatabaseConnectionCommand extends Command
{
    protected static $defaultName = 'app:check-database-connection';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Checks if the Doctrine database connection is working.')
            ->setHelp('This command allows you to test the Doctrine database connection...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $connection = $this->entityManager->getConnection();
            $connection->connect();

            $output->writeln('Database connection is working.');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln('Database connection is not working: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}