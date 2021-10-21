<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use RuntimeException;

class ReadFromFilename implements Pipe
{
    public static string $messageDoesNotExist = 'Filename [%s] does not exist.';
    public static string $messageMustNotBeADirectory = 'Filename [%s] must not be a directory.';
    public static string $messageCouldNotBeRead = 'Filename [%s] could not be read.';
    public static string $messageMustNotBeEmpty = 'Filename [%s] must not be empty.';

    public static function handle(Passable $passable, callable $next): Passable
    {
        $filename = $passable->getDescriptor()->getFilename();

        if (is_null($filename)) {
            return $next($passable);
        }

        if (file_exists($filename) === false) {
            throw new RuntimeException(
                sprintf(static::$messageDoesNotExist, $filename),
            );
        }

        if (is_dir($filename)) {
            throw new RuntimeException(
                sprintf(static::$messageMustNotBeADirectory, $filename),
            );
        }

        $contents = file_get_contents($filename);

        if ($contents === false) {
            throw new RuntimeException(
                sprintf(static::$messageCouldNotBeRead, $filename),
            );
        }

        if (trim($contents) === '') {
            throw new RuntimeException(
                sprintf(static::$messageMustNotBeEmpty, $filename),
            );
        }

        return $next($passable->setDescriptor(
            $passable->getDescriptor()->setText($contents),
        ));
    }
}
