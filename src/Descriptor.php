<?php

declare(strict_types=1);

namespace Authanram\Generators;

use InvalidArgumentException;

abstract class Descriptor
{
    public static string $messageFilename = 'Argument {$filename} must not be empty.';
    public static string $messagePattern = 'Argument {$pattern} must not be empty.';
    public static string $messageText = 'Argument {$stub} must not be empty.';

    private Contracts\Markers $markers;
    private Contracts\Markers $markersResolved;
    private string $filename;
    private string $pattern;
    private string $text;

    /** @return string[] */
    abstract public static function fill(Markers $markers): array;

    public function __construct(string $pattern = null)
    {
        $this->setPattern($pattern);
    }

    public static function filename(): string|null
    {
        return null;
    }

    public static function pattern(): string|null
    {
        return null;
    }

    public function getFilename(): string|null
    {
        return $this->filename ?? static::filename() ?? null;
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
        return $this->pattern ?? static::pattern() ?? '{{ %s }}';
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setFilename(string|null $filename): static
    {
        if (is_null($filename)) {
            return $this;
        }

        if (trim($filename) === '') {
            throw new InvalidArgumentException(static::$messageFilename);
        }

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

    public function setPattern(string|null $pattern): static
    {
        if (is_null($pattern)) {
            return $this;
        }

        if (trim($pattern) === '') {
            throw new InvalidArgumentException(static::$messagePattern);
        }

        $this->pattern = $pattern;

        return $this;
    }

    public function setText(string|null $text): static
    {
        if (is_null($text)) {
            return $this;
        }

        if (trim($text) === '') {
            throw new InvalidArgumentException(static::$messageText);
        }

        $this->text = $text;

        return $this;
    }
}
