<?php

declare(strict_types=1);

namespace Authanram\Generators;

class Generator
{
    private Descriptor $descriptor;

    /** @var Contracts\Pipe[] */
    private array $pipes = [
        Pipes\ReadFromFilename::class,
        Pipes\ExecuteFillCallback::class,
        Pipes\ResolveMarkers::class,
        Pipes\ReplaceMarkers::class,
        Pipes\PostConditions::class,
    ];

    public static function make(Descriptor $descriptor): static
    {
        return (new static)->setDescriptor(
            $descriptor->setFilename($descriptor::filename()),
        );
    }

    public function setDescriptor(Descriptor $descriptor): static
    {
        $this->descriptor = $descriptor;

        return $this;
    }

    public function generate(array $markers, string $stub = null): Descriptor
    {
        $this->descriptor
            ->setMarkers(Markers::make($markers))
            ->setText($stub);

        return Pipeline::handle(Passable::make($this->descriptor), $this->pipes)
            ->getDescriptor();
    }
}
