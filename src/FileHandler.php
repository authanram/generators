<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Filesystem\Filesystem;

final class FileHandler implements Contracts\FileHandler
{
    public static function read(string $filename): string
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return (new Filesystem())->get($filename);
    }

    public static function write(string $filename, string $content): bool|int
    {
        return (new Filesystem())->put($filename, $content);
    }
}
