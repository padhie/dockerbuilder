<?php

declare(strict_types=1);

namespace App\Generator\ContainerGenerator;

use App\Controller\FormParams;
use App\Generator\ContainerParameter;

interface ContainerGeneratorInterface
{
    public function generate(FormParams $params): ?ContainerParameter;
}