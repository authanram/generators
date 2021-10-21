<?php

declare(strict_types=1);

namespace Authanram\Generators;

use InvalidArgumentException;

class Passable implements Contracts\Passable
{
    public static $messageDescriptor = 'Argument {$descriptor} must implement '.Contracts\Descriptor::class;
    public static $messagePattern = 'Argument {$pattern} must not be empty.';
    public static $messageText = 'Argument {$stub} must not be empty.';

    private Contracts\Descriptor|string $descriptor;
    private Contracts\Markers $markers;
    private Contracts\Markers $markersResolved;
    private string $pattern;
    private string $text;

    public static function make(
        Contracts\Descriptor|string $descriptor,
        string $text,
        string $pattern,
        Contracts\Markers $markers,
    ): static {
        return (new static)
            ->setDescriptor($descriptor)
            ->setText($text)
            ->setPattern($pattern)
            ->setMarkers($markers)
            ->setMarkersResolved(Markers::make());
    }

    public function getDescriptor(): Contracts\Descriptor|string
    {
        return $this->descriptor;
    }

    public function getMarkers(): Contracts\Markers
    {
        return $this->markers;
    }

    public function getMarkersResolved(): Contracts\Markers
    {
        return $this->markersResolved;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setDescriptor(Contracts\Descriptor|string $descriptor): static
    {
        if (is_subclass_of($descriptor, Contracts\Descriptor::class) === false) {
            throw new InvalidArgumentException(static::$messageDescriptor);
        }

        $this->descriptor = $descriptor;

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

    public function setPattern(string $pattern): static
    {
        if (trim($pattern) === '') {
            throw new InvalidArgumentException(static::$messagePattern);
        }

        $this->pattern = $pattern;

        return $this;
    }

    public function setText(string $text): static
    {
        if (trim($text) === '') {
            throw new InvalidArgumentException(static::$messageText);
        }

        $this->text = $text;

        return $this;
    }
}
