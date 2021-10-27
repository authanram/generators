<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

interface Passable
{
    /** @param array<string> $input */
    public function withInput(array $input): self;

    /** @param array<string> $input */
    public function withInputFilled(array $input): self;

    public function withInputPath(string $inputPath): self;

    public function withOutputPath(string $outputPath): self;

    public function withPattern(string $pattern): self;

    public function withTemplate(string $template): self;

    public function useTemplate(string $template): self;

    /** @return array<string> */
    public function input(): array;

    public function inputPath(): string;

    public function outputPath(): string;

    public function pattern(): string;

    public function template(): string;
}
