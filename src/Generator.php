<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Services as Contracts;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

final class Generator
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
        $this->bindFileReaderService();
        $this->bindFileWriterService();
        $this->bindInputService();
        $this->bindPatternService();
        $this->bindPipesService();
        $this->bindTemplateService();
    }

    public static function new(): self
    {
        return new self();
    }

    /** @throws BindingResolutionException */
    public function template(string $template): self
    {
        $this->container->make(Contracts\Template::class)
            ->validateTemplate($template)
            ->withTemplate($template);

        return $this;
    }

    /** @throws BindingResolutionException */
    public function fill(callable $fillCallback): self
    {
        $this->container->make(Contracts\Template::class)
            ->validateFillCallback($fillCallback)
            ->withFillCallback($fillCallback);

        return $this;
    }

    /** @throws BindingResolutionException */
    public function pattern(string $pattern): self
    {
        $this->container->make(Contracts\Pattern::class)
            ->validatePattern($pattern)
            ->withPattern($pattern);

        return $this;
    }

    /**
     * @param array<callable> $pipes
     * @throws BindingResolutionException
     */
    public function pipes(array $pipes): self
    {
        $this->container->make(Contracts\Pipes::class)
            ->validatePipes($pipes)
            ->withPipes($pipes);

        return $this;
    }

    /**
     * @param array<string> $input
     * @throws BindingResolutionException
     */
    public function generate(array $input): self
    {
        $this->container->make(Contracts\Input::class)
            ->validateInput($input)
            ->withInput($input);

        // dd('gen');

        return $this;
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

    private function bindInputService(): void
    {
        $this->container->singleton(
            Contracts\Input::class,
            Services\Input::class,
        );
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
}
