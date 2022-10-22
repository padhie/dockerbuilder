<?php

declare(strict_types=1);

namespace App\Generator;

final class Port
{
    public function __construct(
        private readonly int $external,
        private readonly int $internal
    ) {
    }

    public function toArray(): string
    {
        return $this->external . ":" . $this->internal;
    }
}