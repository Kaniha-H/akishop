<?php

namespace App\Command;

use App\Service\CreateAdminService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-admin',
    description: 'create a new admin user',
)]
class CreateAdminCommand extends Command
{
    public function __construct(
        private readonly CreateAdminService $createAdminService
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('fullname', InputArgument::REQUIRED, 'Fullname of the admin user')
            ->addArgument('email', InputArgument::REQUIRED, 'Email of the admin user')
            ->addArgument('password', InputArgument::REQUIRED, 'Password of the admin user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $fullname = $input->getArgument('fullname');
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $this->createAdminService->create($fullname, $email, $password);

        $io->success('Successfully created admin user.');

        return Command::SUCCESS;
    }
}
