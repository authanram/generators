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

        $filename = $passable->getDescriptor()->getFilename();

        if ($filename === '') {
            return $next($passable);
        }

        if ($file->exists($filename) === false) {
            throw new PipeException($filename, PipeException::MESSAGE_EXISTS);
        }

        if ($file->isDirectory($filename)) {
            throw new PipeException($filename, PipeException::MESSAGE_DIRECTORY);
        }

        if ($file->isReadable($filename) === false) {
            throw new PipeException($filename, PipeException::MESSAGE_READABLE);
        }

        $contents = $file->get($filename);

        if (trim($contents) === '') {
            throw new PipeException($filename, PipeException::MESSAGE_EMPTY);
        }

        return $next($passable->setDescriptor(
            $passable->getDescriptor()->setText($contents),
        ));
    }
}
