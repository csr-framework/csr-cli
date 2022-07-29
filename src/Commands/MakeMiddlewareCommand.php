<?php

namespace Csr\Cli\Commands;

use Csr\Cli\Utils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use RuntimeException;

class MakeMiddlewareCommand extends Command
{
    protected string $stub = __DIR__ . '/../stubs/middleware.stub';

    protected function configure()
    {
        $this
            ->setName('make:middleware')
            ->setDescription('Generate Http Middleware')
            ->setHelp('Generate Http Middleware');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $name = $io->ask('Name:', 'BasicMiddleware', function ($value) {
            if (substr($value, -strlen('Middleware')) !== 'Middleware') {
                throw new RuntimeException('Name of middleware must ended with "Middleware"');
            }

            return $value;
        });

        $path = $io->ask('Folder:', './src/middlewares/');
        $path = Utils::normalizePath($path);

        $status = Utils::createComponent($path, $name, $this->stub);

        if ($status !== 0) {
            $io->error('Cannot create middleware');
            return $status;
        }

        $io->success("Middleware $name created in $path .");
        return $status;
    }
}
