<?php

declare(strict_types=1);

namespace App\Generator\ContainerGenerator;

use App\Controller\FormParams;
use App\Generator\ContainerParameter;
use App\Generator\Environtment;
use App\Generator\Port;
use App\Generator\Volumes;

final class Mysql80Generator implements ContainerGeneratorInterface
{
    public function generate(FormParams $params): ?ContainerParameter
    {
        $containerParameter = new ContainerParameter();

        $containerParameter->image = 'mysql:8.0';
        $containerParameter->containerName = $params->name;
        $containerParameter->command = '--default-authentication-plugin=mysql_native_password';

        $containerParameter->ports[] = new Port(3306, 3306);

         $containerParameter->environments[] = new Environtment('MYSQL_ROOT_PASSWORD', 'root');
         $containerParameter->environments[] = new Environtment('MYSQL_DATABASE', 'discord_notification');
         $containerParameter->environments[] = new Environtment('MYSQL_USER', 'dev');
         $containerParameter->environments[] = new Environtment('MYSQL_PASSWORD', 'dev');

        return $containerParameter;
    }
}