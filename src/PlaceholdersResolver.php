<?php

declare(strict_types=1);

namespace Authanram\Generators;

final class PlaceholdersResolver
{
    /** @return array<string> */
    public static function resolve(string $text, string $pattern): array
    {
        Assert::stringNotEmpty($text, '$text must not be empty.');

        Assert::stringNotEmpty($pattern, '$pattern must not be empty.');

        Assert::contains($pattern, '%s', '$pattern must contain "%%s".');

        $marker = sprintf($pattern, '(.*?)');

        preg_match_all('/'.$marker.'/i', $text, $matches);

        return $matches[1];
    }
}
