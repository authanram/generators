<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pattern;
use Authanram\Generators\Exceptions\InvalidArgumentException;

class MarkersResolver
{
    public static string $messageText = 'Argument {$text} must not be empty.';

    /**
     * @return array<string>
     * @throws InvalidArgumentException
     */
    public static function resolve(string $text, Pattern $pattern): array
    {
        if (trim($text) === '') {
            throw new InvalidArgumentException(
                'text', InvalidArgumentException::MESSAGE_EMPTY,
            );
        }

        $marker = sprintf($pattern->getPhrase(), '(.*?)');

        preg_match_all('/'.$marker.'/i', $text, $matches);

        return $matches[1];
    }
}
