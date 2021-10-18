<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Illuminate\Support\Collection;

interface Markers
{
    public function getItems(): array;
    public function setItems(array $items): static;
    public function toCollection(): Collection;
}
