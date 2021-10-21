<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pattern;
use InvalidArgumentException;

class MarkersResolver
{
    public static string $messageText = 'Argument {$text} must not be empty.';

    /** @return array<string> */
    public static function resolve(string $text, Pattern $pattern): array
    {
        if (trim($text) === '') {
            throw new InvalidArgumentException(static::$messageText);
        }

        $marker = sprintf($pattern->getPhrase(), '(.*?)');

        preg_match_all('/'.$marker.'/i', $text, $matches);

        return $matches[1];
    }
}
