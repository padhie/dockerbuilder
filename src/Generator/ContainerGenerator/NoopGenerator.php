<?php

declare(strict_types=1);

namespace App\Generator\ContainerGenerator;

use App\Controller\FormParams;
use App\Generator\ContainerParameter;

final class NoopGenerator implements ContainerGeneratorInterface
{
    public function generate(FormParams $params): ?ContainerParameter
    {
        return null;
    }
}