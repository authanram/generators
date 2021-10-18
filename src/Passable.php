<?php

declare(strict_types=1);

namespace Authanram\Generators;

use InvalidArgumentException;

class Passable
{
    public static $messageDescriptor = 'Argument {$descriptor} must be subclass of '.Descriptor::class;
    public static $messagePattern = 'Argument {$pattern} must not be empty.';
    public static $messageText = 'Argument {$stub} must not be empty.';

    public Markers $markersResolved;

    public function __construct(
        public Descriptor|string $descriptor,
        public string $pattern,
        public string $text,
        public Markers $markers,
    ) {
        if (is_subclass_of($this->descriptor, Descriptor::class) === false) {
            throw new InvalidArgumentException(static::$messageDescriptor);
        }

        if (trim($pattern) === '') {
            throw new InvalidArgumentException(static::$messagePattern);
        }

        if (trim($text) === '') {
            throw new InvalidArgumentException(static::$messageText);
        }

        $this->markersResolved = Markers::make([], true);
    }
}
