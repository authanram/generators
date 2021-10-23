<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

interface FileHandler
{
    public static function read(string $filename): string;

    public static function readOrReturn(string $filename): string;

    public static function write(string $filename): string;
}
