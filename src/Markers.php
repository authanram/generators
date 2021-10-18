<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Collection;
use InvalidArgumentException;

class Markers implements Contracts\Markers
{
    public static $messageMarkerKey = 'Argument {$items} must only contain keys of type "string".';
    public static $messageMarkerValue = 'Argument {$items[%s]} expected "callable|string", got [%s].';

    protected Collection $collection;
    protected array $items = [];

    protected function __construct(array $items)
    {
        static::authorize($items);

        $this->items = $items;
        $this->collection = new Collection($items);
    }

    public static function make(array $items = []): static
    {
        return new static($items);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): static
    {
        static::authorize($items);

        $this->items = $items;

        return $this;
    }

    public function toCollection(): Collection
    {
        return $this->collection;
    }

    protected static function authorize(array $items): void
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
    }
}
