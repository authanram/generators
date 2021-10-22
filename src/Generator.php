<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Services as Contracts;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;

final class Generator
{
    private Container $app;

    public function __construct()
    {
        $this->app = require __DIR__.'/app.php';
    }

    public static function new(): self
    {
        return new self();
    }

    /** @throws BindingResolutionException */
    public function template(string $template): self
    {
        $this->app->make('template')
            ->validateTemplate($template)
            ->withTemplate($template);

        return $this;
    }

    /** @throws BindingResolutionException */
    public function fill(callable $fillCallback): self
    {
        $this->app->make('template')
            ->validateFillCallback($fillCallback)
            ->withFillCallback($fillCallback);

        return $this;
    }

    /** @throws BindingResolutionException */
    public function pattern(string $pattern): self
    {
        $this->app->make('pattern')
            ->validatePattern($pattern)
            ->withPattern($pattern);

        return $this;
    }

    /**
     * @param array<callable> $pipes
     *
     * @throws BindingResolutionException
     */
    public function pipes(array $pipes): self
    {
        $this->app->make('pipes')->validatePipes($pipes)->withPipes($pipes);

        return $this;
    }

    /**
     * @param array<string> $input
     *
     * @throws BindingResolutionException
     */
    public function generate(array $input): self
    {
        $this->app->make(Contracts\Input::class)
            ->validateInput($input)
            ->withInput($input);

        // dd('gen');

        return $this;
    }
}
