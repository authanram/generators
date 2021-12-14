<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use InvalidArgumentException;

final class Input
{
    /** @param array<string, string> $input */
    public function __construct(private array $input)
    {
    }

    /** @return array<string, mixed> */
    public function all(): array
    {
        return $this->input;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->input);
    }

    public function get(string $key, array|string $default = ''): mixed
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
        $value = $this->get($key);

        if (is_string($value)) {
            return Str::of($value);
        }

        throw new InvalidArgumentException(
            'Expected string, got: '.gettype($value),
        );
    }
}
