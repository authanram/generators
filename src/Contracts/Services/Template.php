<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

use Authanram\Generators\Resolvers\TemplateTypeResolver;

interface Template
{
    public function withTemplate(string $template): Template;

    public function withFillCallback(callable $fillCallback): Template;

    public function type(): TemplateTypeResolver;
}
