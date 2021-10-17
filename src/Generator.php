<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;

class Generator
{
    private function __construct(protected Descriptor $descriptor) {}

    public static function make(Descriptor $descriptor): static
    {
        return new static($descriptor);
    }

    public function generate(array $data, string $text): string
    {
        static::authorize($data, $text);

        collect($data)->map(function (array $item) {
            return $this->descriptor::fill($item);
        })->implode("\n");

        return '';
    }

    private static function authorize(array $data, string $text): void
    {
        if (trim($text) === '') {
            throw new \InvalidArgumentException('Argument {$text} must not be empty.');
        }

        if (count($data) === 0) {
            throw new \InvalidArgumentException('Argument {$data} must not be empty.');
        }
    }

    private static function runCallback(callable $callback, array|string $subject): string
    {
        return static::toCollection($subject)
            ->map(fn (string $item) => $callback(new Stringable($item)))
            ->implode("\n");
    }

    private static function toCollection(array|string $subject): Collection
    {
        return collect(is_array($subject) ? $subject : [$subject]);
    }
}
