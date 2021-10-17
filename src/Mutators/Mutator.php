<?php /** @noinspection PhpMissingReturnTypeInspection */

declare(strict_types=1);

namespace Authanram\Generators\Mutators;

use Authanram\Generators\Contracts\Stringable;
use Authanram\Generators\Generator;
use Authanram\Generators\Subject;
use Authanram\Generators\TYPE;
use Illuminate\Support\Fluent;

abstract class Mutator
{
    public const TYPE = TYPE::class;

    protected Fluent $args;

    abstract public static function handle(Subject $subject): Stringable|string;

    public function resolve(callable $callback, Generator $passable, Subject $subject): Generator
    {
        return $passable->handle($callback, $subject);
    }
}
