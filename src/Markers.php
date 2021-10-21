<?php

declare(strict_types=1);

namespace Authanram\Generators;

use InvalidArgumentException;

class Markers implements Contracts\Markers
{
    public static string $messageMarkerKey = 'Argument {$items} must only contain keys of type "string".';
    public static string $messageMarkerValue = 'Argument {$items[%s]} expected "callable|string", got [%s].';
    public static string $messageMarkerKeyGet = 'Argument {$marker} does not match any known marker named [%s].';

    /** @var array<string> */
    private array $items;

    /**
     * @param array<string> $items
     * @return static
     */
    public static function make(array $items = []): static
    {
        return (new static())->setItems($items);
    }

    /** @return array<string> */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array<string> $items
     * @return $this
     */
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
