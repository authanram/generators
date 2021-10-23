<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

interface FileWriter
{
    public function write(string $filename): string;
}
