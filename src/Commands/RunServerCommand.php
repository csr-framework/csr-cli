<?php

namespace Csr\Cli\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RunServerCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('boot')
            ->setHelp('Run application')
            ->setDescription('Run application')
            ->addOption('port', 'p', InputOption::VALUE_OPTIONAL, 'The port for development server', 8080)
            ->addOption('host', null, InputOption::VALUE_OPTIONAL, 'The host for development server', 'localhost');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $port = $input->getOption('port');
        $host = $input->getOption('host');

        $io = new SymfonyStyle($input, $output);

        $cmd = sprintf('php -S %s:%d server.php', $host, $port);

        $io->writeln("\033[104m\033[30m #UKR\033[0m\033[0m\033[103m\033[30mAINE \033[0m\033[0m");

        passthru($cmd, $status);

        if ($status) {
            $io->error('Error while running application');
        }

        return $status;
    }
}
