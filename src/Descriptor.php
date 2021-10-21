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

        $this->withPattern($pattern);
    }

    /** @return array<string> */
    abstract public static function fill(Markers $markers): array;

    public static function stub(): string
    {
        return '';
    }

    public static function phrase(): string
    {
        return '';
    }

    public function filename(): string
    {
        return $this->filename ?? static::stub();
    }

    public function markers(): Contracts\Markers
    {
        return $this->markers;
    }

    public function markersResolved(): Contracts\Markers
    {
        return $this->markersResolved ?? Markers::make();
    }

    /**
     * @throws Exceptions\InvalidArgument
     * @throws Exceptions\InvalidPatternPhrase
     */
    public function pattern(): Contracts\Pattern
    {
        return static::phrase() !== ''
            ? Pattern::make(static::phrase())
            : $this->pattern ?? Pattern::make();
    }

    public function text(): string
    {
        return $this->text ?? '';
    }

    public function withFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function withMarkers(Contracts\Markers $markers): static
    {
        $this->markers = $markers;

        return $this;
    }

    public function withMarkersResolved(Contracts\Markers $markersResolved): static
    {
        $this->markersResolved = $markersResolved;

        return $this;
    }

    public function withPattern(Contracts\Pattern $pattern): static
    {
        $this->pattern = $pattern;

        return $this;
    }

    public function withText(string $text): static
    {
        $this->text = $text;

        return $this;
    }
}
