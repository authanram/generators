<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Passable as Contract;

final class Passable implements Contract
{
    /** @var array<string> */
    private array $input = [];

    private string $inputPath = '';

    private string $outputPath = '';

    private string $pattern = '';

    private string $template = '';

    /** @param array<string> $input */
    public function withInput(array $input): self
    {
        Assert::input($input);

        $this->input = $input;

        return $this;
    }

    /** @param array<string> $input */
    public function withInputFilled(array $input): self
    {
        Assert::inputFilled($input);

        $this->input = $input;

        return $this;
    }

    public function withInputPath(string $inputPath): self
    {
        Assert::inputPath($inputPath);

        $this->inputPath = $inputPath;

        return $this;
    }

    public function withOutputPath(string $outputPath): self
    {
        Assert::outputPath($outputPath);

        $this->outputPath = $outputPath;

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
        $this->withPattern($this->pattern);

        Assert::template($template);

        Assert::templateVariables($template, $this->pattern);

        $this->template = $template;

        return $this;
    }

    public function useTemplate(string $template): self
    {
        Assert::template($template);

        $this->template = $template;

        return $this;
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

    public function outputPath(): string
    {
        return $this->outputPath;
    }

    public function pattern(): string
    {
        return $this->pattern;
    }

    public function template(): string
    {
        return $this->template;
    }
}
