<?php

declare(strict_types=1);

namespace Authanram\Generators;

final class Passable
{
    private Descriptor|string $descriptor;

    /** @var array<string> */
    private array $input;

    private string $output;

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

    public function descriptor(): Descriptor|string|null
    {
        return $this->descriptor ?? null;
    }

    /** @return array<string> */
    public function input(): array
    {
        return $this->input ?? [];
    }

    public function output(): string|null
    {
        return $this->output ?? null;
    }
}
