<?php

declare(strict_types=1);

namespace Authanram\Generators\Resolvers;

use Illuminate\Support\Str;

final class TemplateTypeResolver
{
    private string $extension;
    private string $template;

    public static function with(string $template): self
    {
        $instance = new self();
        $instance->template = $template;

        return $instance;
    }

    public function withExtension(string $extension): self
    {
        $this->extension = ltrim($extension, '.');

        return $this;
    }

    public function isFilename(): bool
    {
        return (Str::of($this->template)->endsWith('.'.$this->extension)
            && file_exists($this->template)
            && is_file($this->template)
            && is_readable($this->template)
        );
    }

    public function isRaw(): bool
    {
        return $this->isFilename() === false;
    }
}
