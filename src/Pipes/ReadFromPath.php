<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
use RuntimeException;

class ReadFromPath implements Pipe
{
    public static function handle(Passable $passable, $next): Passable
    {
        $descriptor = $passable->getDescriptor();

        if (is_null($descriptor::path())) {
            return $next($passable);
        }

        if (file_exists($descriptor::path()) === false) {
            throw new RuntimeException(
                'Stub ['.$descriptor::path().'] defined at ['.$descriptor::class.'] does not exist.',
            );
        }

        $contents = file_get_contents($descriptor::path());

        if ($contents === false) {
            throw new RuntimeException(
                'Stub ['.$descriptor::path().'] defined at ['.$descriptor::class.'] could not be read.',
            );
        }

        if (trim($contents) === '') {
            throw new RuntimeException(
                'Stub ['.$descriptor::path().'] defined at ['.$descriptor::class.'] is empty.',
            );
        }

        return $next($passable->setDescriptor(
            $descriptor->setText($contents),
        ));
    }
}
