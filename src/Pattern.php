<?php

declare(strict_types=1);

namespace Authanram\Generators;

use InvalidArgumentException;

class Pattern implements Contracts\Pattern
{
    public static string $messagePatternEmpty = 'Argument {$phrase} must not be empty.';
    public static string $messagePatternInvalid = 'Invalid {$phrase}. Must contain "%s", e.g. "{{ %s }}';

    private string $phrase;

    public static function make(string $phrase = '{{ %s }}'): static
    {
        if (trim($phrase) === '') {
            throw new InvalidArgumentException(static::$messagePatternEmpty);
        }

        if (str_contains($phrase, '%s') === false) {
            throw new InvalidArgumentException(static::$messagePatternInvalid);
        }

        $instance = new static();

        $instance->phrase = $phrase;

        return $instance;
    }

    public function getPhrase(): string
    {
        return $this->phrase;
    }
}
