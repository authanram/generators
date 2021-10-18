<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pipe;
use Illuminate\Container\Container;
use Illuminate\Pipeline\Pipeline as IlluminatePipeline;

class Pipeline
{
    private function __construct() {}

    public static function handle(Passable $passable, array $pipes): Passable
    {
        static::authorize($pipes);

        // @todo inject container
        return (new IlluminatePipeline(new Container))
            ->send($passable)
            ->through($pipes)
            ->thenReturn();
    }

    private static function authorize(array $pipes): void
    {
        foreach ($pipes as $pipe) {
            if (is_subclass_of($pipe, Pipe::class)) {
                continue;
            }

            throw new \InvalidArgumentException(
                'Pipe must implement {'.Pipe::class.'}',
            );
        }
    }
}
