<?php

declare(strict_types=1);

namespace Authanram\Generators;

class Generator
{
    private Descriptor $descriptor;

    /** @var array<Contracts\Pipe> */
    private array $pipes = [
        Pipes\ReadFromFilename::class,
        Pipes\ExecuteFillCallback::class,
        Pipes\ResolveMarkers::class,
        Pipes\ReplaceMarkers::class,
        Pipes\PostConditions::class,
    ];

    public static function make(Descriptor $descriptor): static
    {
        if (trim($descriptor::filename()) !== '') {
            $descriptor->setFilename($descriptor::filename());
        }

        $generator = new static();
        $generator->descriptor = $descriptor;

        return $generator;
    }

    /** @param array<string> $markers */
    public function generate(array $markers, string|null $stub = null): Descriptor
    {
        $this->descriptor->setMarkers(Markers::make($markers));

        if (is_null($stub) === false) {
            $this->descriptor->setText($stub);
        }

        return Pipeline::handle(Passable::make($this->descriptor), $this->pipes)
            ->getDescriptor();
    }
}
