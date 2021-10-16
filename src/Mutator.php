<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Closure;
use Illuminate\Support\Stringable;

abstract class Mutator
{
    abstract public function handle(Stringable $subject): Stringable|string;

    public static function make(...$args): static
    {
        return new static($args);
    }

    public static function resolve(Closure $callback, Generator $passable, string $attribute = null): Generator
    {
        return $passable->handle($callback, static::placeholder(), $attribute ?? static::attribute());
    }

    public static function attribute(): string
    {
        return static::$attribute;
    }

    public static function placeholder(): string
    {
        return '{{ '.static::$placeholder.' }}';
    }
}
