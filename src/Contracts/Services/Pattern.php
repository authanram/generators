<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

interface Pattern
{
    public function validate(string $pattern): Pattern;

    public function withPattern(string $pattern): void;
}
