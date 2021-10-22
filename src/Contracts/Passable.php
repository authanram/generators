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

    public function withOutputFilename(string|null $outputFilename): self;

    public function descriptor(): Descriptor|string|null;

    /** @return array<string> */
    public function input(): array;

    public function output(): string;

    public function outputFilename(): string;
}
