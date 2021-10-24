<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Passable as Contract;
use Closure;

final class Passable implements Contract
{
    private Closure|null $fillCallback = null;

    /** @var array<string> */
    private array $input = [];

    private string $inputPath = '';

    private string $pattern = '';

    private string $template = '';

    /** @var array<string> */
    private array $variables = [];

    public function withFillCallback(callable $fillCallback): self
    {
        Assert::isCallable($fillCallback);

        $this->fillCallback = $fillCallback;

        return $this;
    }

    /** @param array<string> $input */
    public function withInputFilled(array $input): self
    {
        Assert::inputFilled($input);

        $this->input = $input;

        return $this;
    }

    /** @param array<string> $input */
    public function withInput(array $input): self
    {
        Assert::input($input);

        $this->input = $input;

        return $this;
    }

    public function withInputPath(string $inputPath): self
    {
        Assert::inputPath($inputPath);

        $this->inputPath = $inputPath;

        return $this;
    }

    public function withPattern(string $pattern): self
    {
        Assert::pattern($pattern);

        $this->pattern = $pattern;

        return $this;
    }

    public function withTemplate(string $template): self
    {
        Assert::stringNotEmpty(
            $template,
            Assert::message(Assert::EMPTY, '$template'),
        );

        $this->template = $template;

        return $this;
    }

    /** @param array<string> $variables */
    public function withVariables(array $variables): self
    {
        Assert::inputFilled($variables);

        $this->variables = $variables;

        return $this;
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

    public function inputPath(): string
    {
        return $this->inputPath;
    }

    public function pattern(): string
    {
        return $this->pattern;
    }

    public function template(): string
    {
        return $this->template;
    }

    /** @return array<string> */
    public function variables(): array
    {
        return $this->variables;
    }
}
