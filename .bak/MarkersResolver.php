<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pattern as Contract;
use Authanram\Generators\Exceptions\InvalidArgument;

final class MarkersResolver
{
    /**
     * @return array<string>
     *
     * @throws InvalidArgument
     * @throws Exceptions\InvalidPatternPhrase
     */
    public static function resolve(
        string $text,
        Contract|null $pattern = null,
    ): array {
        $pattern = is_null($pattern) ? Pattern::make() : $pattern;

        if (trim($text) === '') {
            throw new InvalidArgument('$text', InvalidArgument::EMPTY);
        }

        $marker = sprintf($pattern->phrase(), '(.*?)');

        preg_match_all('/'.$marker.'/i', $text, $matches);

        return $matches[1];
    }
}
