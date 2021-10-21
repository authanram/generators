<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use InvalidArgumentException;

interface Markers
{
    /** @throws InvalidArgumentException */
    public static function make(array $items = []): static;

    public function getItems(): array;

    /** @throws InvalidArgumentException */
    public function setItems(array $items): static;

    /** @throws InvalidArgumentException */
    public function get(string $marker): callable|string;
}
