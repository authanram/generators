<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Generator
{
    private function __construct(private array $attributes, private string $code) {}

    public static function make(array $attributes, string $code): static
    {
        return new static($attributes, $code);
    }

    public function out(): string
    {
        return $this->code;
    }

    public function handle(Closure $callback, string $placeholder, string $attribute): static
    {
        $output = $this->generate($callback, $this->attributes[$attribute]);

        return $this->replace($placeholder, $output);
    }

    private function replace(string $search, string $replace): static
    {
        $this->code = str_replace($search, $replace, $this->code);

        return $this;
    }

    private function generate(Closure $callback, array|string $attribute): string
    {
        return $this->toCollection($attribute)
            ->map(fn (string $item) => $callback(Str::of($item)))
            ->implode("\n");
    }

    private function toCollection(array|string $subject): Collection
    {
        return collect(is_array($subject) ? $subject : [$subject]);
    }
}
