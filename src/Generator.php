<?php

declare(strict_types=1);

namespace Authanram\Generators;

class Generator
{
    /** @var Pipe[] */
    protected array $pipes = [
        Pipes\ExecuteFillCallback::class,
        Pipes\ResolveMarkers::class,
        Pipes\ReplaceMarkers::class,
        Pipes\PostConditions::class,
    ];

    public function __construct(protected Descriptor|string $descriptor, array $pipes = null)
    {
        $this->pipes = $pipes ?? $this->pipes;
    }

    public function generate(string $stub, array $markers, string $pattern = '{{ %s }}'): string
    {
        $passable = new Passable(
            $this->descriptor,
            $pattern,
            $stub,
            Markers::make($markers, true),
        );

        return Pipeline::handle($passable, $this->pipes)->text;
    }
}
