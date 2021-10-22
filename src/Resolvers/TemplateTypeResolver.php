<?php

declare(strict_types=1);

namespace Authanram\Generators\Resolvers;

use Illuminate\Support\Str;

final class TemplateTypeResolver
{
    private string $template;

    public static function with(string $template): self
    {
        $instance = new self();
        $instance->template = $template;

        return $instance;
    }

    public function isFilename(): bool
    {
        return Str::of($this->template)->endsWith('.stub');
    }

    public function isRaw(): bool
    {
        return $this->isFilename() === false;
    }
}
