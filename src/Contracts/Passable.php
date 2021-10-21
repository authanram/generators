<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use InvalidArgumentException;

interface Passable
{
    public static function make(Descriptor|string $descriptor, string $text, string $pattern, Markers $markers): static;

    public function getDescriptor(): Descriptor|string;

    public function getMarkers(): Markers;

    public function getMarkersResolved(): Markers;

    public function getPattern(): string;

    public function getText(): string;

    /** @throws InvalidArgumentException */
    public function setDescriptor(Descriptor|string $descriptor): static;

    public function setMarkers(Markers $markers): static;

    public function setMarkersResolved(Markers $markersResolved): static;

    /** @throws InvalidArgumentException */
    public function setPattern(string $pattern): static;

    /** @throws InvalidArgumentException */
    public function setText(string $text): static;
}
