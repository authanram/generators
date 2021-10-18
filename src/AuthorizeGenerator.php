<?php

declare(strict_types=1);

namespace Authanram\Generators;

trait AuthorizeGenerator
{
    private static function authorizeMake(Descriptor|string $descriptor, array $pipes): void
    {
        if ((is_string($descriptor) && $descriptor !== Descriptor::class)
            && is_subclass_of($descriptor, Descriptor::class) === false
        ) {
            throw new \InvalidArgumentException(
                'Argument {$descriptor} must be subclass of '.Descriptor::class,
            );
        }

        if (count($pipes) === 0) {
            throw new \InvalidArgumentException(
                'Argument {$pipes} must not be empty.',
            );
        }
    }

    private static function authorizeGenerate(string $stub, array $markers): void
    {
        if (trim($stub) === '') {
            throw new \InvalidArgumentException(
                'Argument {$stub} must not be empty.',
            );
        }

        if (count($markers) === 0) {
            throw new \InvalidArgumentException(
                'Argument {$markers} must not be empty.',
            );
        }
    }

    private static function authorizeMarkers(array $markers): void
    {
        if (count($markers) === 0) {
            throw new \InvalidArgumentException(
                'Argument {$markers} must not be empty.',
            );
        }

        foreach ($markers as $key => $value) {
            static::authorizeMarkerKey($key);
            static::authorizeMarkerValue($value);
        }
    }

    private static function authorizeMarkerKey(string|int $subject): void
    {
        if (is_string($subject) === false) {
            throw new \InvalidArgumentException(
                'Argument {$markers} must only contain keys of type "string".',
            );
        }
    }

    private static function authorizeMarkerValue($subject): void
    {
        if (is_string($subject) === false && is_callable($subject) === false) {
            throw new \InvalidArgumentException(
                'Argument {$markers} must only contain values of type "callable|string".',
            );
        }
    }
}
