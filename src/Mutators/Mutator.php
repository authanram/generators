<?php /** @noinspection PhpMissingReturnTypeInspection */

declare(strict_types=1);

namespace Authanram\Generators\Mutators;

use Authanram\Generators\Generator;
use Authanram\Generators\Subject;
use Illuminate\Support\Stringable;

abstract class Mutator
{
    abstract public static function handle(Subject $subject): Stringable|string;

    public function resolve(callable $callback, Generator $passable, Subject $subject): Generator
    {
        return $passable->handle($callback, $subject);
    }
}
