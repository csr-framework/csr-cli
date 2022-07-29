<?php

namespace Csr\Cli\Commands;

use Csr\Cli\Utils;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeControllerCommand extends Command
{
    protected string $httpStub = __DIR__ . '/../stubs/http-controller.stub';
    protected string $jsonStub = __DIR__ . '/../stubs/json-controller.stub';

    protected function configure()
    {
        $this
            ->setName('make:controller')
            ->setDescription('Generate Controller')
            ->setHelp('Generate Controller');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $name = $io->ask('Name:', 'HomeController', function ($value) {
            if ($value === 'HttpController' || $value === 'JsonController') {
                throw new RuntimeException('Name "HttpController" or "JsonController" is reserved by framework. Please use another name');
            }

            if (substr($value, -strlen('Controller')) !== 'Controller') {
                throw new RuntimeException('Name of controller must ended with "Controller"');
            }

            return $value;
        });

        $path = $io->ask('Folder:', './src/controllers/');

        $type = $io->choice('Type:', ['http', 'json'], 0);

        $stub = $type === 'http' ? $this->httpStub : $this->jsonStub;

        $path = Utils::normalizePath($path);
        $status = Utils::createComponent($path, $name, $stub);

        if ($status !== 0) {
            $io->error('Cannot create controller');
            return $status;
        }

        $io->success("Controller $name created in $path .");
        return $status;
    }
}
