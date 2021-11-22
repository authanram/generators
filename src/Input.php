<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

final class Input
{
    /** @param array<string, string> $input */
    public function __construct(private array $input)
    {
    }

    /** @return array<string, string> */
    public function all(): array
    {
        return $this->input;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->input);
    }

    public function get(string $key, array|string $default = ''): array|string
    {
        if ($default !== '') {
            return $this->input[$key] ?? $default;
        }

        $message = Assert::message(Assert::KEY_EXISTS, $key);

        Assert::keyExists($this->input, $key, $message);

        return $this->input[$key];
    }

    public function str(string $key): Stringable
    {
        return Str::of($this->get($key));
    }
}
