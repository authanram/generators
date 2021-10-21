<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Descriptor;
use Authanram\Generators\Contracts\Pipe;

class Generator
{
    private Descriptor|string $descriptor;
    private string $path;
    private string $stub;

    /** @var Pipe[] */
    private array $pipes = [
        Pipes\ReadFromPath::class,
        Pipes\ExecuteFillCallback::class,
        Pipes\ResolveMarkers::class,
        Pipes\ReplaceMarkers::class,
        Pipes\PostConditions::class,
    ];

    public static function make(Descriptor|string $descriptor, string $stub): static
    {
        return (new static)->setDescriptor($descriptor)->setStub($stub);
    }

    public function getDescriptor(): Descriptor|string
    {
        return $this->descriptor;
    }

    public function getStub(): string
    {
        return $this->stub;
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


    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function setStub(string $stub): static
    {
        $this->stub = $stub;

        return $this;
    }

    public function generate(array $markers, string $pattern = '{{ %s }}'): string
    {
        $passable = Passable::make(
            $this->getDescriptor(),
            $this->getStub(),
            $pattern,
            Markers::make($markers),
        );

        return Pipeline::handle($passable, $this->getPipes())->getText();
    }

    public function setPipes(array $pipes): static
    {
        $this->pipes = $pipes;

        return $this;
    }
}
