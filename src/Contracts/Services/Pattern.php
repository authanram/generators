<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

interface Pattern
{
    public function validatePattern(string $pattern): Pattern;

    public function withPattern(string $pattern): Pattern;
}
