<?php

declare(strict_types=1);

namespace App\Generator;

class ContainerParameter
{
    public string $image = '';

    public string $containerName = '';

    public ?string $command = null;

    /** @var list<Port> */
    public array $ports = [];

    /** @var list<Volumes> */
    public array $volumes = [];

    public ?string $workingDir = null;

    /** @var list<Environtment> */
    public array $environments = [];

    final public function toArray(): array
    {
        $environments = [];
        foreach ($this->environments as $environment) {
            assert($environment instanceof Environtment);
            $environments[$environment->key] = $environment->value;
        }

        return [
            'image' => $this->image,
            'container_name' => $this->containerName,
            'command' => $this->command,
            'ports' => array_map(static fn (Port $port) => $port->toArray(), $this->ports),
            'volumes' => array_map(static fn (Volumes $volume) => $volume->toArray(), $this->volumes),
            'working_dir' => $this->workingDir,
            'environment' => $environments,
        ];
    }
}