<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

interface FileReader
{
    public function read(string $filename): string;
}
