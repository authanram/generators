<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Descriptor;
use Authanram\Generators\Contracts\Pipe;

class Generator
{
    use GeneratorProperties;

    /** @var Pipe[] */
    protected array $pipes = [
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

    public function generate(array $markers, string $pattern = '{{ %s }}'): string
    {
        $passable = new Passable(
            $this->descriptor,
            $this->stub,
            $pattern,
            Markers::make($markers),
        );

        return Pipeline::handle($passable, $this->pipes)->text;
    }
}
