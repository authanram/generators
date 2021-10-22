<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Template as Contract;
use Authanram\Generators\Resolvers\TemplateTypeResolver;
use Illuminate\Support\Collection;

final class Template extends Service implements Contract
{
    public function template(): string
    {
        return $this->passable()->output();
    }

    public function fillCallback(): callable
    {
        return static fn (Collection $data) => $this->passable()
            ->descriptor()::fill($data);
    }

    public function type(): TemplateTypeResolver
    {
        return TemplateTypeResolver::with($this->template());
    }
}
