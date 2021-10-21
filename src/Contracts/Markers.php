<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use InvalidArgumentException;

interface Markers
{
    /**
     * @param array<string> $items
     * @throws InvalidArgumentException
     */
    public static function make(array $items = []): static;

    /** @return array<string> */
    public function getItems(): array;

    /** @throws InvalidArgumentException */
    public function get(string $marker): callable|string;
}
