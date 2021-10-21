<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Exceptions\ReadFromFilenamePipeFailureException as PipeException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;

class ReadFromFilename implements Pipe
{
    /**
     * @throws PipeException
     * @throws FileNotFoundException
     */
    public static function handle(Passable $passable, callable $next): Passable
    {
        $file = new Filesystem;

        $filename = $passable->descriptor()->filename();

        if ($filename === '') {
            return $next($passable);
        }

        if ($file->exists($filename) === false) {
            throw new PipeException($filename);
        }

        if ($file->isDirectory($filename)) {
            throw new PipeException($filename, PipeException::DIRECTORY);
        }

        if ($file->isReadable($filename) === false) {
            throw new PipeException($filename, PipeException::READABLE);
        }

        $contents = $file->get($filename);

        if (trim($contents) === '') {
            throw new PipeException($filename, PipeException::EMPTY);
        }

        return $next($passable->withDescriptor(
            $passable->descriptor()->withText($contents),
        ));
    }
}
