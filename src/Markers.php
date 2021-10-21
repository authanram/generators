<?php

declare(strict_types=1);

namespace Authanram\Generators;

use InvalidArgumentException;

class Markers implements Contracts\Markers
{
    public static $messageMarkerKey = 'Argument {$items} must only contain keys of type "string".';
    public static $messageMarkerValue = 'Argument {$items[%s]} expected "callable|string", got [%s].';
    public static $messageMarkerKeyGet = 'Argument {$marker} does not match any known marker named [%s].';

    private array $items;

    public static function make(array $items = []): static
    {
        return (new static)->setItems($items);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): static
    {
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

        $this->items = $items;

        return $this;
    }

    public function get(string $marker): callable|string
    {
        if (isset($this->items[$marker]) === false) {
            throw new InvalidArgumentException(
                sprintf(static::$messageMarkerKeyGet, $marker),
            );
        }

        return $this->items[$marker];
    }
}
