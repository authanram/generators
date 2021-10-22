<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Template as Contract;
use Authanram\Generators\Data;
use Authanram\Generators\Resolvers\TemplateTypeResolver;

final class Template extends Service implements Contract
{
    public function template(): string
    {
        return $this->passable()->output();
    }

    public function fillCallback(): callable
    {
        return static fn (Data $data) => $this->passable()
            ->descriptor()::fill($data);
    }

    public function type(): TemplateTypeResolver
    {
        return TemplateTypeResolver::with($this->template());
    }
}
