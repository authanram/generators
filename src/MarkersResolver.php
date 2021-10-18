<?php

declare(strict_types=1);

namespace Authanram\Generators;

use InvalidArgumentException;

class MarkersResolver
{
    public static $messageText = 'Argument {$text} must not be empty.';
    public static $messagePatternEmpty = 'Argument {$pattern} must not be empty.';
    public static $messagePatternInvalid = 'Invalid pattern. Must contain "%s", e.g. "{{ %s }}';

    public static function resolve(string $text, string $pattern = '{{ %s }}'): array
    {
        if (trim($text) === '') {
            throw new InvalidArgumentException(static::$messageText);
        }

        if (trim($pattern) === '') {
            throw new InvalidArgumentException(static::$messagePatternEmpty);
        }

        if (str_contains($pattern, '%s') === false) {
            throw new InvalidArgumentException(static::$messagePatternInvalid);
        }

        preg_match_all('/'.sprintf($pattern, '(.*?)').'/i', $text, $matches);

        return $matches[1];
    }
}
