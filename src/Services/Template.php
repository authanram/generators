<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Template as Contract;
use Authanram\Generators\Resolvers\TemplateTypeResolver;

final class Template implements Contract
{
    public function validateTemplate(string $subject): Contract
    {
        $validation = app()->services()->validation();

        if ($this->type('foo')->isRaw()) {
            $validation->rules(['subject' => 'required|string']);
        } else {
            $validation->rules(['subject' => 'required']);
        }

        $validation->validate(['subject' => 123]);

        return $this;
    }

    public function withTemplate(string $subject): Contract
    {
        return $this;
    }

    public function validateFillCallback(callable $fillCallback): Contract
    {
        return $this;
    }

    public function withFillCallback(callable $fillCallback): Contract
    {
        return $this;
    }

    private function type(string $template): TemplateTypeResolver
    {
        return TemplateTypeResolver::with($template);
    }
}
