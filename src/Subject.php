<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Fluent;
use Illuminate\Support\Stringable;

class Subject
{
    public Fluent $payload;

    public function __construct(public Stringable $value, public string $placeholder, array $payload = [])
    {
        $this->payload = new Fluent($payload);
    }

    public static function make(Stringable $value, string $placeholder, array $options = []): static
    {
        return new static($value, $placeholder, $options);
    }
}
