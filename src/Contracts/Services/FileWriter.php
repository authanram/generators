<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

interface FileWriter
{
    public function write(string $filename): void;
}
