<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

use Authanram\Generators\Resolvers\TemplateTypeResolver;

interface Template
{
    public function template(): string;

    public function fillCallback(): callable;

    public function type(): TemplateTypeResolver;
}
