<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Exceptions\InvalidArgumentException;
use Authanram\Generators\Exceptions\InvalidPatternPhraseException;

class Pattern implements Contracts\Pattern
{
    private string $phrase;

    /**
     * @throws InvalidArgumentException
     * @throws InvalidPatternPhraseException
     */
    public static function make(string $phrase = '{{ %s }}'): static
    {
        if (trim($phrase) === '') {
            throw new InvalidArgumentException('$phrase');
        }

        if (str_contains($phrase, '%s') === false) {
            throw new InvalidPatternPhraseException($phrase);
        }

        $instance = new static();

        $instance->phrase = $phrase;

        return $instance;
    }

    public function phrase(): string
    {
        return $this->phrase;
    }
}
