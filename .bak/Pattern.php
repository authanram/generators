<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pattern as Contract;
use Authanram\Generators\Exceptions\InvalidArgument;
use Authanram\Generators\Exceptions\InvalidPatternPhrase;

final class Pattern implements Contract
{
    private string $phrase;

    /**
     * @throws InvalidArgument
     * @throws InvalidPatternPhrase
     */
    public static function make(string $phrase = '{{ %s }}'): Contract
    {
        if (trim($phrase) === '') {
            throw new InvalidArgument('$phrase');
        }

        if (str_contains($phrase, '%s') === false) {
            throw new InvalidPatternPhrase($phrase);
        }

        $instance = new self();

        $instance->phrase = $phrase;

        return $instance;
    }

    public function phrase(): string
    {
        return $this->phrase;
    }
}
