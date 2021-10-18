<?php

declare(strict_types=1);

namespace Authanram\Generators;

class Generator
{
    use AuthorizeGenerator;

    public function __construct(protected Descriptor|string $descriptor, protected array $pipes)
    {
        static::authorizeMake($descriptor, $pipes);
    }

    public function generate(string $stub, array $markers): string
    {
        static::authorizeGenerate($stub, $markers);

        static::authorizeMarkers($markers);

        $passable = Passable::create($this->descriptor, $markers, $stub);

        return Pipeline::handle($passable, $this->pipes)->text;
    }
}
