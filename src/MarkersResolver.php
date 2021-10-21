<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pattern;
use Authanram\Generators\Exceptions\InvalidArgumentException;

class MarkersResolver
{
    /**
     * @return array<string>
     * @throws InvalidArgumentException
     */
    public static function resolve(string $text, Pattern $pattern): array
    {
        if (trim($text) === '') {
            throw new InvalidArgumentException(
                '$text', InvalidArgumentException::EMPTY,
            );
        }

        $marker = sprintf($pattern->phrase(), '(.*?)');

        preg_match_all('/'.$marker.'/i', $text, $matches);

        return $matches[1];
    }
}
