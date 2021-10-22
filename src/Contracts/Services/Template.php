<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

interface Template
{
    public function validate(string $subject): Template;

    public function withTemplate(string $subject): void;

    public function withCallbacks(string $subject): void;
}
