<?php

declare(strict_types=1);

namespace Authanram\Generators;

final class Input
{
    /** @param array<string> $input */
    public function __construct(private array $input)
    {
    }

    public function get(string $key): string
    {
        $message = Assert::message(Assert::KEY_EXISTS, $key);

        Assert::keyExists($this->input, $key, $message);

        return $this->input[$key];
    }
}
