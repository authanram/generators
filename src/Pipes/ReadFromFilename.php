<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Exceptions\ReadFromFilenamePipeFailure as Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;

final class ReadFromFilename implements Pipe
{
    /**
     * @throws Exception
     */
    public static function handle(Passable $passable, callable $next): Passable
    {
        $filename = $passable->descriptor()->filename();

        if ($filename === '') {
            return $next($passable);
        }

        $filesystem = new Filesystem();

        self::authorize($filesystem, $filename);

        $fileContents = self::read($filesystem, $filename);

        if (trim($fileContents) === '') {
            throw new Exception($filename, Exception::EMPTY);
        }

        return $next($passable->withDescriptor(
            $passable->descriptor()->withText($fileContents),
        ));
    }

    /** @throws Exception */
    private static function authorize(Filesystem $file, string $filename): void
    {
        $codes = [
            Exception::EXISTS => $file->exists($filename),
            Exception::DIRECTORY => $file->isDirectory($filename) === false,
            Exception::READABLE => $file->isReadable($filename),
        ];

        $subject = array_search(false, $codes, true);

        if (is_int($subject) === false) {
            return;
        }

        throw new Exception($filename, $subject);
    }

    private static function read(Filesystem $file, string $filename): string
    {
        try {
            return $file->get($filename);
        } catch (FileNotFoundException) {
            return '';
        }
    }
}
