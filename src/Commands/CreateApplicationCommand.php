<?php

namespace Csr\Cli\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateApplicationCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('init')
            ->setDescription('Initialize application using Composer')
            ->setHelp('Initialize application');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $name = $io->ask('Enter project name:', 'app');

        $cmd = sprintf('composer create-project csr/app %s', $name);
        passthru($cmd, $status);

        if ($status) {
            $io->error('Error while initialize application');
        }

        return $status;
    }
}
