<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Closure;

interface Passable
{
    public function withFilename(string $filename): self;

    public function withFillCallback(callable $fillCallback): self;

    /** @param array<string> $input */
    public function withInput(array $input): self;

    public function withPattern(string $pattern): self;

    /** @param array<string> $placeholders */
    public function withPlaceholders(array $placeholders): self;

    public function withStub(string $stub): self;

    public function filename(): string;

    public function fillCallback(): Closure;

    /** @return array<string> */
    public function input(): array;

    public function pattern(): string;

    /** @return array<string> */
    public function placeholders(): array;

    public function stub(): string;
}
