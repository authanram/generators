<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Collection;
use InvalidArgumentException;

class Markers extends Collection
{
    public static $messageMarkers = 'Argument {$items} must not be empty.';
    public static $messageMarkerKey = 'Argument {$items} must only contain keys of type "string".';
    public static $messageMarkerValue = 'Argument {$items[%s]} expected "callable|string", got [%s].';

    protected function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function make($items = [], bool $forceAllowEmpty = false): static
    {
        if ($forceAllowEmpty === false && count($items) === 0) {
            throw new InvalidArgumentException(static::$messageMarkers);
        }

        foreach ($items as $key => $value) {
            if (is_string($key) === false) {
                throw new InvalidArgumentException(
                    sprintf(static::$messageMarkerKey, $key),
                );
            }

            if (is_string($value) === false && is_callable($value) === false) {
                throw new InvalidArgumentException(
                    sprintf(static::$messageMarkerValue, $key, $value),
                );
            }
        }

        return parent::make($items);
    }
}
