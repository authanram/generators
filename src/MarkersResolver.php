<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pattern;
use Authanram\Generators\Exceptions\InvalidArgument;

final class MarkersResolver
{
    /**
     * @return array<string>
     *
     * @throws InvalidArgument
     */
    public static function resolve(string $text, Pattern $pattern): array
    {
        if (trim($text) === '') {
            throw new InvalidArgument('$text', InvalidArgument::EMPTY);
        }

        $marker = sprintf($pattern->phrase(), '(.*?)');

        preg_match_all('/'.$marker.'/i', $text, $matches);

        return $matches[1];
    }
}
