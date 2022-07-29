<?php

use Csr\Cli\Commands\CreateApplicationCommand;
use Csr\Cli\Commands\MakeControllerCommand;
use Csr\Cli\Commands\MakeMiddlewareCommand;
use Csr\Cli\Commands\RunServerCommand;
use Symfony\Component\Console\Application;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new Application('CSR CLI', 'v0.1');

$app->addCommands([
    new RunServerCommand(),
    new CreateApplicationCommand(),
    new MakeControllerCommand(),
    new MakeMiddlewareCommand()
]);

$app->run();
