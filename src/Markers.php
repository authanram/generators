<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Markers as Contract;
use Authanram\Generators\Exceptions\MarkerResolutionFailure;

final class Markers implements Contract
{
    /** @var array<string> */
    private array $items;

    /**
     * @param array<string> $items
     *
     * @return static
     */
    public static function make(array $items = []): Contract
    {
        $markers = new self();

        foreach ($items as $key => $value) {
            $markers->addItem($key, $value);
        }

        return $markers;
    }

    /** @return array<string> */
    public function items(): array
    {
        return $this->items;
    }

    /**
     * @throws MarkerResolutionFailure
     */
    public function get(string $marker): callable|string
    {
        if (isset($this->items[$marker]) === false) {
            throw new MarkerResolutionFailure($marker);
        }

        return $this->items[$marker];
    }

    private function addItem(string $key, string|callable $value): void
    {
        $this->items[$key] = $value;
    }
}
