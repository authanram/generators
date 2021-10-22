<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\FileReader as Contract;

final class FileReader extends Service implements Contract
{
    public function read(string $filename): string
    {
        return $filename;
    }
}
