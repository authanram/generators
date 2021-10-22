<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Template as Contract;
use Authanram\Generators\Resolvers\TemplateTypeResolver;
use Closure;

final class Template implements Contract
{
    private string $template;

    private Closure $fillCallbackCallable;

    public function withTemplate(string $template): Contract
    {
        $this->template = $template;

        return $this;
    }

    public function withFillCallback(callable $fillCallback): Contract
    {
        $this->fillCallbackCallable = $fillCallback;

        return $this;
    }

    public function template(): string
    {
        return $this->template;
    }

    public function fillCallback(): Closure
    {
        return $this->fillCallbackCallable;
    }

    public function type(): TemplateTypeResolver
    {
        return TemplateTypeResolver::with($this->template);
    }
}
