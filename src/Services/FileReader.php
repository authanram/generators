<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\FileReader as Contract;
use Illuminate\Filesystem\Filesystem;

final class FileReader extends Service implements Contract
{
    private Filesystem $file;

    public function __construct()
    {
        $this->file = new Filesystem();
    }

    public function read(string $filename): string
    {
        return $filename;
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function readOrReturn(string $filename): string
    {
        $shouldRead = $this->file->isFile($filename)
            && $this->file->isReadable($filename);

        if ($shouldRead) {
            return $this->file->get($filename);
        }

        return $filename;
    }
}
