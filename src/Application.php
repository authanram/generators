<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Services\FileReader;
use Authanram\Generators\Contracts\Services\FileWriter;
use Authanram\Generators\Contracts\Services\Input;
use Authanram\Generators\Contracts\Services\Pattern;
use Authanram\Generators\Contracts\Services\Pipes;
use Authanram\Generators\Contracts\Services\Template;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application as IlluminateApplication;
use Illuminate\Contracts\Translation\Loader;
use Illuminate\Support\Facades\Facade;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

final class Application
{
    private Container $app;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $app = new Container();
        $app->singleton('app', IlluminateApplication::class);
        $app->bind(Loader::class, ArrayLoader::class);
        $translationLoader = $app->make(Loader::class);
        $app->instance('translator', new Translator($translationLoader, 'en'));

        $app->singleton('validator', fn ($app) => new Factory(
            $app['translator'],
            $app,
        ));

        /** @noinspection PhpParamsInspection */
        Facade::setFacadeApplication($app);

        $this->app = $app;
        $this->registerSingletons();
        $this->registerAliases();
    }

    public static function create(): self
    {
        return new self();
    }

    public function registerSingletons(): void
    {
        $this->app->singleton(FileReader::class, Services\FileReader::class);
        $this->app->singleton(FileWriter::class, Services\FileWriter::class);
        $this->app->singleton(Input::class, Services\Input::class);
        $this->app->singleton(Pattern::class, Services\Pattern::class);
        $this->app->singleton(Pipes::class, Services\Pipes::class);
        $this->app->singleton(Template::class, Services\Template::class);
    }

    public function registerAliases(): void
    {
        $this->app->alias(FileReader::class, 'file.reader');
        $this->app->alias(FileWriter::class, 'file.writer');
        $this->app->alias(Input::class, 'input');
        $this->app->alias(Pattern::class, 'pattern');
        $this->app->alias(Pipes::class, 'pipes');
        $this->app->alias(Template::class, 'template');
    }
}
