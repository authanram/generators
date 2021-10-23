<?php

declare(strict_types=1);

namespace Authanram\Generators;

abstract class Descriptor
{
    abstract public static function stub(): string;

    /** @return array<string> */
    abstract public static function fill(Input $data): array;

    public static function pattern(): string
    {
        return '{{ %s }}';
    }

    /** @return array<callable> */
    public static function pipes(): array
    {
        return [
            Pipes\ResolveTemplatePipe::class,
            Pipes\ResolvePlaceholdersPipe::class,
            Pipes\ExecuteFillCallbackPipe::class,
            Pipes\PreprocessPipe::class,
            Pipes\ReplacePlaceholdersPipe::class,
            Pipes\PostprocessPipe::class,
        ];
    }
}
