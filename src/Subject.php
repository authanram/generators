<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Support\Fluent;

class Subject
{
    public Fluent $options;

    public function __construct(public Stringable $value, public string $placeholder, array $options = [])
    {
        $this->options = new Fluent($options);
    }

    public static function make(Stringable $value, string $placeholder, array $options = []): static
    {
        return new static($value, $placeholder, $options);
    }
}
