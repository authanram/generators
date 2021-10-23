<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Passable as Contract;
use Closure;

final class Passable implements Contract
{
    private string $filename = '';

    private Closure|null $fillCallback = null;

    /** @var array<string> */
    private array $input = [];

    private string $pattern = '';

    /** @var array<string> */
    private array $placeholders = [];

    private string $stub = '';

    public function withFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function withFillCallback(callable $fillCallback): self
    {
        Assert::isCallable($fillCallback);

        $this->fillCallback = $fillCallback;

        return $this;
    }

    /** @param array<string> $input */
    public function withInput(array $input): self
    {
        Assert::input($input);

        $this->input = $input;

        return $this;
    }

    public function withPattern(string $pattern): self
    {
        Assert::pattern($pattern);

        $this->pattern = $pattern;

        return $this;
    }

    /** @param array<string> $placeholders */
    public function withPlaceholders(array $placeholders): self
    {
        Assert::input($placeholders);

        $this->placeholders = $placeholders;

        return $this;
    }

    public function withStub(string $stub): self
    {
        Assert::stub($stub);

        $this->stub = $stub;

        return $this;
    }

    public function filename(): string
    {
        return $this->filename;
    }

    /** @noinspection ClassMethodNameMatchesFieldNameInspection */
    public function fillCallback(): Closure
    {
        return $this->fillCallback
            ?? static fn (Input $input): array => $input->toArray();
    }

    /** @return array<string> */
    public function input(): array
    {
        return $this->input;
    }

    public function pattern(): string
    {
        return $this->pattern;
    }

    /** @return array<string> */
    public function placeholders(): array
    {
        return $this->placeholders;
    }

    public function stub(): string
    {
        return $this->stub;
    }
}
