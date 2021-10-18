<?php

declare(strict_types=1);

namespace Authanram\Generators;

trait GeneratorProperties
{
    protected Descriptor|string $descriptor;
    protected array $callbacks;
    protected array $markers;
    protected string $path;
    protected string $pattern;
    protected string $stub;

    public function getDescriptor(): Descriptor|string
    {
        return $this->descriptor;
    }

    public function getStub(): string
    {
        return $this->stub;
    }

    public function getMarkers(): array
    {
        return $this->markers;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getPipes(): array
    {
        return $this->pipes;
    }

    public function setDescriptor(Descriptor|string $descriptor): static
    {
        $this->descriptor = $descriptor;

        return $this;
    }

    public function setMarkers(array $markers): static
    {
        $this->markers = $markers;

        return $this;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function setPattern(string $pattern): static
    {
        $this->pattern = $pattern;

        return $this;
    }

    public function setPipes(array $pipes): static
    {
        $this->pipes = $pipes;

        return $this;
    }

    public function setStub(string $stub): static
    {
        $this->stub = $stub;

        return $this;
    }
}
