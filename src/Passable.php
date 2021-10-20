<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Descriptor;
use InvalidArgumentException;

class Passable implements Contracts\Passable
{
    public static $messageDescriptor = 'Argument {$descriptor} must implement '.Descriptor::class;
    public static $messagePattern = 'Argument {$pattern} must not be empty.';
    public static $messageText = 'Argument {$stub} must not be empty.';

    public Contracts\Markers $markersResolved;

    public function __construct(
        public Descriptor|string $descriptor,
        public string $text,
        public string $pattern,
        public Contracts\Markers $markers,
    ) {
        $this->markersResolved = Markers::make();
        $this->generate();
    }

    protected function generate(): void
    {
        if (is_subclass_of($this->descriptor, Descriptor::class) === false) {
            throw new InvalidArgumentException(static::$messageDescriptor);
        }

        if (trim($this->text) === '') {
            throw new InvalidArgumentException(static::$messageText);
        }

        if (trim($this->pattern) === '') {
            throw new InvalidArgumentException(static::$messagePattern);
        }
    }
}
