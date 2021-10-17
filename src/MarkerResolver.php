<?php

declare(strict_types=1);

namespace Authanram\Generators;

use InvalidArgumentException;

class MarkerResolver
{
    public static function resolve(string $text, string $pattern = '{{ %s }}'): array
    {
        static::authorize($text, $pattern);

        return static::matches($text, $pattern);
    }

    private static function authorize(string $text, string $pattern): void
    {
        if (trim($text) === '') {
            return;
        }

        if (str_contains($pattern, '%s') === false) {
            throw new InvalidArgumentException(
                'Invalid pattern. Must contain "%s", e.g. "{{ %s }}',
            );
        }
    }

    private static function pattern(string $pattern): string
    {
        return '/'.sprintf($pattern, '(.*?)').'/i';
    }

    private static function matches(string $text, string $pattern): array
    {
        preg_match_all(static::pattern($pattern), $text, $matches);

        return $matches[0];
    }
}
