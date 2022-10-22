<?php

declare(strict_types=1);

namespace App\Generator;

final class Environtment
{
    public function __construct(
        public readonly string $key,
        public readonly string $value
    ) {
    }
}