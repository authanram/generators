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
        if (trim($descriptor::stub()) !== '') {
            $descriptor->withFilename($descriptor::stub());
        }

        $generator = new static();
        $generator->descriptor = $descriptor;

        return $generator;
    }

    /**
     * @param array<string> $markers
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\MustImplementInterfaceException
     */
    public function generate(array $markers, string|null $stub = null): Descriptor
    {
        $this->descriptor->withMarkers(Markers::make($markers));

        if (is_null($stub) === false) {
            $this->descriptor->withText($stub);
        }

        return Pipeline::handle(Passable::make($this->descriptor), $this->pipes)
            ->descriptor();
    }
}
