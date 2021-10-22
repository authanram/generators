<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

interface Template
{
    public function validateTemplate(string $subject): Template;

    public function withTemplate(string $subject): Template;

    public function validateFillCallback(callable $fillCallback): Template;

    public function withFillCallback(callable $fillCallback): Template;
}
