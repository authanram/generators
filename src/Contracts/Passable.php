<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Closure;

interface Passable
{
    public function withFillCallback(callable $fillCallback): self;

    /** @param array<string> $input */
    public function withInput(array $input): self;

    /** @param array<string> $input */
    public function withInputFilled(array $input): self;

    public function withInputPath(string $inputPath): self;

    public function withPattern(string $pattern): self;

    public function withTemplate(string $template): self;

    /** @param array<string> $variables */
    public function withVariables(array $variables): self;

    public function fillCallback(): Closure;

    /** @return array<string> */
    public function input(): array;

    public function inputPath(): string;

    public function pattern(): string;

    public function template(): string;

    /** @return array<string> */
    public function variables(): array;
}
