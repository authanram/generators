<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Filesystem\Filesystem;

final class FileHandler implements Contracts\FileHandler
{
    public static function read(string $filename): string
    {
        return $filename;
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public static function readOrReturn(string $filename): string
    {
        $file = new Filesystem();

        $shouldRead = $file->isFile($filename)
            && $file->isReadable($filename);

        if ($shouldRead) {
            return $file->get($filename);
        }

        return $filename;
    }

    public static function write(string $filename): string
    {
        return $filename;
    }
}
