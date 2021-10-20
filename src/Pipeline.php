<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pipe;
use Illuminate\Container\Container;
use Illuminate\Pipeline\Pipeline as IlluminatePipeline;
use InvalidArgumentException;

class Pipeline
{
    public static $messagePipes = 'Argument {$pipes} must not be empty.';
    public static $messagePipe = 'Argument {$pipes[%s]} must implement "'.Pipe::class.'".';

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
        if (count($pipes) === 0) {
            throw new InvalidArgumentException(static::$messagePipes);
        }

        foreach ($pipes as $pipe) {
            if (is_subclass_of($pipe, Pipe::class)) {
                continue;
            }

            throw new InvalidArgumentException(sprintf(static::$messagePipe, $pipe));
        }
    }
}
