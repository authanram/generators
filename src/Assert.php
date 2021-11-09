<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pipe;
use Closure;
use Webmozart\Assert\Assert as WebmozartAssert;

final class Assert extends WebmozartAssert
{
    public const CONTAINS = '{%s} must contain [%s].';
    public const FILE = '[%s] be a file.';
    public const FILE_NOT_FOUND = 'File [%s] not found.';
    public const IMPLEMENTS_INTERFACE = '[%s] must implement [%s].';
    public const KEY_EXISTS = 'Undefined array key [%s].';
    public const NOT_EMPTY = '{%s} must not be empty.';
    public const NOT_EMPTY_MAP = '{%s} must be a non empty map.';
    public const READABLE = '[%s] must be readable.';
    public const RETURNS_NOT_EMPTY_MAP = '%s must return a non empty map.';
    public const SUBCLASS_OF = '[%s] must be a subclass of [%s].';
    public const UNIQUE_VALUES = '{%s} must have unique values.';
    public const VARIABLE = '{%s} must contain at least one template variable.';
    public const WRITEABLE = '[%s] must be writeable.';
    public const LENGTH = '{%s} must contain at least %s characters.';

    public static function message(string $message, mixed ...$arguments): string
    {
        return sprintf($message, ...$arguments);
    }

    /** @param Descriptor|string $value */
    public static function descriptor(mixed $value): void
    {
        $message = self::message(self::NOT_EMPTY, '$descriptor');

        self::notEq($value, '', $message);

        $message = self::message(self::SUBCLASS_OF, $value, Descriptor::class);

        self::nullOrSubclassOf($value, Descriptor::class, $message);
    }

    /** @param array<string> $value */
    public static function input(array $value): void
    {
        $message = self::message(self::NOT_EMPTY, '$input');

        self::notEmpty($value, $message);

        $message = self::message(self::NOT_EMPTY_MAP, '$input');

        self::isNonEmptyMap($value, $message);
    }

    /** @param array<string> $value */
    public static function inputFilled(array $value): void
    {
        $message = self::message(self::RETURNS_NOT_EMPTY_MAP, 'fill()');

        self::isNonEmptyMap($value, $message);
    }

    public static function inputPath(string $value): void
    {
        $message = self::message(self::NOT_EMPTY, '$inputPath');

        self::stringNotEmpty($value, $message);

        $message = self::message(self::FILE_NOT_FOUND, $value);

        self::file($value, $message);

        $message = self::message(self::READABLE, $value);

        self::readable($value, $message);
    }

    public static function outputPath(string $value): void
    {
        $message = self::message(self::NOT_EMPTY, '$outputPath');

        self::stringNotEmpty($value, $message);

        if (file_exists($value) === false) {
            return;
        }

        $message = self::message(self::FILE, $value);

        self::file($value, $message);

        $message = self::message(self::WRITEABLE, $value);

        self::writable($value, $message);
    }

    public static function pattern(string $value): void
    {
        $message = self::message(self::NOT_EMPTY, '$pattern');

        self::stringNotEmpty($value, $message);

        $message = self::message(self::CONTAINS, '$pattern', '%%s');

        self::contains($value, '%s', $message);

        $message = self::message(self::LENGTH, '$pattern', 8);

        self::minLength($value, 8, $message);
    }

    /** @param array<string> $value */
    public static function pipes(array $value): void
    {
        $message = self::message(self::NOT_EMPTY, '$pipes');

        self::isNonEmptyList($value, $message);

        $message = self::message(self::UNIQUE_VALUES, '$pipes');

        self::uniqueValues($value, $message);

        $message = static function (string $pipe): string {
            return self::message(
                self::IMPLEMENTS_INTERFACE,
                $pipe,
                Pipe::class,
            );
        };

        foreach ($value as $pipe) {
            self::implementsInterface($pipe, Pipe::class, $message($pipe));
        }
    }

    public static function template(string $value): void
    {
        $message = self::message(self::NOT_EMPTY, '$template');

        self::notEmpty($value, $message);
    }

    public static function templateVariables(
        string $value,
        string $pattern,
    ): void {
        $hasTemplateVariables = TemplateVariablesResolver::hasTemplateVariables(
            $value,
            $pattern,
        );

        $message = self::message(self::VARIABLE, '$template');

        self::true($hasTemplateVariables, $message);
    }
}
