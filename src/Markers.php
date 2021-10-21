<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Exceptions\MarkerResolutionFailureException;

class Markers implements Contracts\Markers
{
    /** @var array<string> */
    private array $items;

    /**
     * @param array<string> $items
     * @return static
     */
    public static function make(array $items = []): static
    {
        $markers = new static();

        foreach ($items as $key => $value) {
            $markers->addItem($key, $value);
        }

        return $markers;
    }

    /** @return array<string> */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @throws MarkerResolutionFailureException
     */
    public function get(string $marker): callable|string
    {
        if (isset($this->items[$marker]) === false) {
            throw new MarkerResolutionFailureException(
                $marker, MarkerResolutionFailureException::MESSAGE_EXISTS,
            );
        }

        return $this->items[$marker];
    }

    private function addItem(string $key, string|callable $value): void
    {
        $this->items[$key] = $value;
    }
}
