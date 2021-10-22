<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Authanram\Generators\Descriptor;

interface Passable
{
    public static function make(Descriptor|string $descriptor): self;

    /** @param array<string> $input */
    public function withInput(array $input): self;

    public function withOutput(string $output): self;

    /** @param array<string> $placeholders */
    public function withPlaceholders(array $placeholders): self;

    public function withToFilename(string|null $outputFilename): self;

    public function descriptor(): Descriptor|string|null;

    /** @return array<string> */
    public function input(): array;

    public function output(): string;

    /** @return array<string> */
    public function placeholders(): array;

    public function toFilename(): string;
}
