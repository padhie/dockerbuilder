<?php

declare(strict_types=1);

namespace App\Generator;

final class Volumes
{
    public function __construct(
        private readonly string $external,
        private readonly string $internal
    ) {
    }

    public function toArray(): string
    {
        return $this->external . ":" . $this->internal;
    }
}