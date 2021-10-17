<?php

declare(strict_types=1);

namespace Authanram\Generators;

class Pipeline
{
    private function __construct() {}

    public static function handle(array $pipes, Passable $passable): void
    {
        (new \Illuminate\Pipeline\Pipeline());
    }
}
