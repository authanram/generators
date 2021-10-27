<?php

declare(strict_types=1);

namespace Authanram\Generators;

final class TemplateVariablesResolver
{
    /** @return array<string> */
    public static function resolve(string $template, string $pattern): array
    {
        Assert::stringNotEmpty(
            $template,
            Assert::message(Assert::NOT_EMPTY, '$template'),
        );

        Assert::pattern($pattern);

        $templateVariable = sprintf($pattern, '(.*?)');

        preg_match_all('/'.$templateVariable.'/i', $template, $matches);

        return $matches[1];
    }

    public static function hasTemplateVariables(
        string $template,
        string $pattern
    ): bool {
        return count(self::resolve($template, $pattern)) > 0;
    }
}
