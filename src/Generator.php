<?php

declare(strict_types=1);

namespace Authanram\Generators;

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

    public static function fromPath(string $path): static
    {
        return (new static)->setPath($path);
    }

    public function generate(): string
    {
        $passable = new Passable(
            $this->descriptor,
            $this->pattern,
            $this->stub,
            Markers::make($this->pipes),
        );

        return Pipeline::handle($passable, $this->pipes)->text;
    }
}
