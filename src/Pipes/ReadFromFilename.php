<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Exceptions\ReadFromFilenamePipeFailure as PipeException;
use Authanram\Generators\Helpers;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;

final class ReadFromFilename implements Pipe
{
    /**
     * @throws PipeException
     * @throws FileNotFoundException
     */
    public static function handle(Passable $passable, callable $next): Passable
    {
        $filename = $passable->descriptor()->filename();

        if ($filename === '') {
            return $next($passable);
        }

        $file = new Filesystem();

        $validation = [
            PipeException::EXISTS => $file->exists($filename),
            PipeException::DIRECTORY => $file->isDirectory($filename) === false,
            PipeException::READABLE => $file->isReadable($filename),
        ];

        Helpers::pipe(array_search(false, $validation, true), fn ($code) => is_int($code)
            ? throw new PipeException($filename, $code)
            : null,
        );

        $fileContents = $file->get($filename);

        if (trim($fileContents) === '') {
            throw new PipeException($filename, PipeException::EMPTY);
        }

        return $next($passable->withDescriptor(
            $passable->descriptor()->withText($fileContents),
        ));
    }
}
