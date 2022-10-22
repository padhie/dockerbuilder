<?php

declare(strict_types=1);

namespace App\Generator;

use App\Controller\FormParams;
use App\Generator\ContainerGenerator\ContainerGeneratorInterface;
use Symfony\Component\Yaml\Yaml;

final class YamlGenerator
{
    /**
     * @param array<int, FormParams> $params
     */
    public function generate(array $params): string
    {
        $containers = [];
        foreach ($params as $param) {
            assert($param instanceof FormParams);

            $generator = $this->detectContainerGenerator($param->image);
            $containers[$param->name] = $generator->generate($param);
        }

        return $this->generateYaml(
            array_filter($containers)
        );
    }

    private function detectContainerGenerator(string $image): ContainerGeneratorInterface
    {
        return match ($image) {
            'php_8.1_cli' => new ContainerGenerator\Php81CliGenerator(),
            'php_8.1_apache' => new ContainerGenerator\Php81ApacheGenerator(),
            'mysql_8.0' => new ContainerGenerator\Mysql80Generator(),
            default => new ContainerGenerator\NoopGenerator(),
        };
    }

    /**
     * @param array<string, ContainerParameter> $containers
     */
    public function generateYaml(array $containers): string
    {
        $services = [];

        foreach ($containers as $name => $container) {
            assert($container instanceof ContainerParameter);
            $services[$name] = array_filter($container->toArray());
        }

        return Yaml::dump([
            'version' => 3,
            'services' => $services,
        ], 99);
    }
}