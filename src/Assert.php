<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pipe;
use Webmozart\Assert\Assert as WebmozartAssert;

final class Assert extends WebmozartAssert
{
    public const CONTAINS = '{%s} must contain [%s].';
    public const EMPTY = '{%s} must not be empty.';
    public const EMPTY_MAP = '{%s} must be a non empty key value map.';
    public const IMPLEMENTS = '[%s] must implement [%s].';
    public const SUBCLASS = '[%s] must be a subclass of [%s].';
    public const UNIQUE_VALUES = '{%s} must have unique values.';

    public static function message(string $message, mixed ...$arguments): string
    {
        return sprintf($message, ...$arguments);
    }

    /** @param array<string> $value */
    public static function input(array $value): void
    {
        $message = self::message(self::EMPTY, '$input');

        self::notEmpty($value, $message);

        $message = self::message(self::EMPTY_MAP, '$input');

        self::isNonEmptyMap($value, $message);
    }

    public static function descriptor(string $value): void
    {
        $message = self::message(self::EMPTY, '$descriptor');

        self::stringNotEmpty($value, $message);

        $message = self::message(self::SUBCLASS, $value, Descriptor::class);

        self::subclassOf($value, Descriptor::class, $message);
    }

    public static function filename(string $value): void
    {
        $message = self::message(self::EMPTY, '$filename');

        self::stringNotEmpty($value, $message);
    }

    public static function pattern(string $value): void
    {
        $message = self::message(self::EMPTY, '$pattern');

        self::stringNotEmpty($value, $message);

        $message = self::message(self::CONTAINS, '$pattern', '%s');

        self::contains($value, '%s', $message);
    }

    /** @param array<string> $value */
    public static function pipes(array $value): void
    {
        $message = self::message(self::EMPTY, '$pipes');

        self::isNonEmptyList($value, $message);

        $message = self::message(self::UNIQUE_VALUES, '$pipes');

        self::uniqueValues($value, $message);

        $message = static function (string $pipe): string {
            return self::message(self::IMPLEMENTS, $pipe, Pipe::class);
        };

        foreach ($value as $pipe) {
            self::implementsInterface($pipe, Pipe::class, $message($pipe));
        }
    }

    public static function stub(string $value): void
    {
        $message = self::message(self::EMPTY, '$stub');

        self::stringNotEmpty($value, $message);
    }
}
