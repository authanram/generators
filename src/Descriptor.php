<?php

declare(strict_types=1);

namespace Authanram\Generators;

abstract class Descriptor
{
    private Contracts\Markers $markers;
    private Contracts\Markers $markersResolved;
    private Contracts\Pattern $pattern;
    private string $filename;
    private string $text;

    public function __construct(Pattern|null $pattern = null)
    {
        if (is_null($pattern)) {
            return;
        }

        $this->setPattern($pattern);
    }

    /** @return array<string> */
    abstract public static function fill(Markers $markers): array;

    public static function filename(): string
    {
        return '';
    }

    public static function pattern(): string
    {
        return '';
    }

    public function getFilename(): string
    {
        return $this->filename ?? static::filename();
    }

    public function getMarkers(): Contracts\Markers
    {
        return $this->markers;
    }

    public function getMarkersResolved(): Contracts\Markers
    {
        return $this->markersResolved ?? Markers::make();
    }

    public function getPattern(): Contracts\Pattern
    {
        return static::pattern() !== ''
            ? Pattern::make(static::pattern())
            : $this->pattern ?? Pattern::make();
    }

    public function getText(): string
    {
        return $this->text ?? '';
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function setMarkers(Contracts\Markers $markers): static
    {
        $this->markers = $markers;

        return $this;
    }

    public function setMarkersResolved(Contracts\Markers $markersResolved): static
    {
        $this->markersResolved = $markersResolved;

        return $this;
    }

    public function setPattern(Contracts\Pattern $pattern): static
    {
        $this->pattern = $pattern;

        return $this;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }
}
