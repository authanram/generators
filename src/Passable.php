<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Fluent;

class Passable
{
    public function __construct(public Descriptor $descriptor, public Item $item) {}

    public static function create(Descriptor $descriptor, array $data): static
    {
        return new static($descriptor, Item::create(new Fluent($data)));
    }
}
