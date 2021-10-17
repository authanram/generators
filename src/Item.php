<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Fluent;

class Item
{
    public function __construct(public Fluent $item) {}

    public static function create(Fluent $item): static
    {
        return new static($item);
    }
}
