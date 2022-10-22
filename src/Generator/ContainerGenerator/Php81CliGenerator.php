<?php

declare(strict_types=1);

namespace App\Generator\ContainerGenerator;

use App\Controller\FormParams;
use App\Generator\ContainerParameter;
use App\Generator\Environtment;
use App\Generator\Port;
use App\Generator\Volumes;

final class Php81CliGenerator implements ContainerGeneratorInterface
{
    public function generate(FormParams $params): ?ContainerParameter
    {
        $containerParameter = new ContainerParameter();

        $containerParameter->image = 'thecodingmachine/php:8.1.0-v4-cli';
        $containerParameter->containerName = $params->name;
        $containerParameter->workingDir = '/application';

        $containerParameter->ports[] = new Port(9000, 9000); // xdebug default port
        $containerParameter->ports[] = new Port(9003, 9003); // xdebug default port

        $containerParameter->volumes[] = new Volumes('.', $containerParameter->workingDir);

        $containerParameter->environments[] = new Environtment('PHP_EXTENSION_XDEBUG', '1');
        $containerParameter->environments[] = new Environtment('XDEBUG_CONFIG', 'remote_host=host.docker.internal');
        $containerParameter->environments[] = new Environtment('STARTUP_COMMAND_1', 'echo "startup command"');

        return $containerParameter;
    }
}