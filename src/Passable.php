<?php

declare(strict_types=1);

namespace Authanram\Generators;

class Passable
{
    protected function __construct(
        public Descriptor|string $descriptor,
        public Marker $item,
        public string $text,
        public array $markers = [],
    ) {}

    public static function create(Descriptor|string $descriptor, array $marker, string $text): static
    {
        return new static($descriptor, new Marker($marker), $text);
    }
}
