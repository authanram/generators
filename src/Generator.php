<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Contracts\Services as Contracts;
use Authanram\Generators\Services;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

final class Generator
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
        $this->bindPatternService();
        $this->bindTemplateService();
        $this->bindPipesService();
        $this->bindFileReaderService();
        $this->bindFileWriterService();
    }

    public static function new(): self
    {
        return new self();
    }

    /** @throws BindingResolutionException */
    public function template(string $template): self
    {
        $this->container->make(Contracts\Template::class)
            ->validate($template)
            ->withTemplate($template);

        return $this;
    }

    /** @throws BindingResolutionException */
    public function fill(array|string $callbacks): self
    {
        $this->container->make(Contracts\Template::class)
            ->validate($callbacks);

        return $this;
    }

    /** @throws BindingResolutionException */
    public function pattern(string $pattern): self
    {
        $this->container->make(Contracts\Pattern::class)
            ->validate($pattern)
            ->withPattern($pattern);

        return $this;
    }

    /**
     * @param array<Pipe|string> $pipes
     * @throws BindingResolutionException
     */
    public function pipes(array $pipes): self
    {
        $this->container->make(Contracts\Pipes::class)
            ->validate($pipes)
            ->withPipes($pipes);

        return $this;
    }

    public function generate(): self
    {
        dd('gen');

        return $this;
    }

    private function bindTemplateService(): void
    {
        $this->container->singleton(
            Contracts\Template::class,
            Services\Template::class,
        );
    }

    private function bindPatternService(): void
    {
        $this->container->singleton(
            Contracts\Pattern::class,
            Services\Pattern::class,
        );
    }

    private function bindPipesService(): void
    {
        $this->container->singleton(
            Contracts\Pipes::class,
            Services\Pipes::class,
        );
    }

    private function bindFileReaderService(): void
    {
        $this->container->singleton(
            Contracts\Pipes::class,
            Services\Pipes::class,
        );
    }

    private function bindFileWriterService(): void
    {
        $this->container->singleton(
            Contracts\Pipes::class,
            Services\Pipes::class,
        );
    }
}
