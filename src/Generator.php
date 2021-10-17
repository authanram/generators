<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;
use Illuminate\Support\Stringable;

class Generator
{
    private function __construct(protected Fluent $attributes, protected string $code) {}

    public static function make(array $attributes, string $code): static
    {
        return new static(new Fluent($attributes), $code);
    }

    public function handle(callable $callback, Subject $subject): static
    {
        $output = $this->generate($callback, $subject->value);

        return $this->replace($subject->placeholder, $output);
    }

    private function replace(string $search, string $replace): static
    {
        $this->code = str_replace($search, $replace, $this->code);

        return $this;
    }

    private function generate(callable $callback, array|string $attribute): string
    {
        return $this->toCollection($attribute)
            ->map(fn (string $item) => $callback(new Stringable($item)))
            ->implode("\n");
    }

    private function toCollection(array|string $subject): Collection
    {
        return collect(is_array($subject) ? $subject : [$subject]);
    }
}
