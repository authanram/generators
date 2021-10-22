<?php

declare(strict_types=1);

namespace Authanram\Generators\Resolvers;

final class MarkersResolver
{
    /** @return array<string> */
    public static function resolve(string $text, string $pattern): array
    {
//        if (trim($text) === '') {
//        }

        $marker = sprintf($pattern, '(.*?)');

        preg_match_all('/'.$marker.'/i', $text, $matches);

        return $matches[1];
    }
}
