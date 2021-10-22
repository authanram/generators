<?php

declare(strict_types=1);

namespace Authanram\Generators;

final class Passable implements Contracts\Passable
{
    private Descriptor|string $descriptor;

    /** @var array<string> */
    private array $input;

    private string $output;

    /** @var array<string> */
    private array $placeholders;

    private string $toFilename;

    public static function make(Descriptor|string $descriptor): self
    {
        $instance = new self();

        $instance->descriptor = $descriptor;

        return $instance;
    }

    /** @param array<string> $input */
    public function withInput(array $input): self
    {
        $this->input = $input;

        return $this;
    }

    public function withOutput(string $output): self
    {
        $this->output = $output;

        return $this;
    }

    /** @param array<string> $placeholders */
    public function withPlaceholders(array $placeholders): self
    {
        $this->placeholders = $placeholders;

        return $this;
    }

    public function withToFilename(string|null $outputFilename): self
    {
        $this->toFilename = $outputFilename ?? '';

        return $this;
    }

    public function descriptor(): Descriptor|string|null
    {
        return $this->descriptor ?? null;
    }

    /** @return array<string> */
    public function input(): array
    {
        return $this->input ?? [];
    }

    public function output(): string
    {
        return $this->output ?? '';
    }

    /** @return array<string> */
    public function placeholders(): array
    {
        return $this->placeholders ?? [];
    }

    public function toFilename(): string
    {
        return $this->toFilename ?? '';
    }
}
