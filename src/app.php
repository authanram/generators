<?php

declare(strict_types=1);

use Authanram\Generators\Container;
use Authanram\Generators\Contracts\Services as Contracts;
use Authanram\Generators\Services;
use Illuminate\Contracts\Translation\Loader;
use Illuminate\Support\Facades\Facade;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

$app = new Container();

$app->singleton('app', Container::class);

$app->bind(Loader::class, ArrayLoader::class);

/** @noinspection PhpUnhandledExceptionInspection */
$translationLoader = $app->make(Loader::class);

$app->instance('translator', new Translator($translationLoader, 'en'));

$app->singleton('validator', static fn ($app) => new Factory(
    $app['translator'],
    $app,
));

/** @noinspection PhpParamsInspection */
Facade::setFacadeApplication($app);

$app->singleton(Contracts\FileReader::class, Services\FileReader::class);
$app->singleton(Contracts\FileWriter::class, Services\FileWriter::class);
$app->singleton(Contracts\Input::class, Services\Input::class);
$app->singleton(Contracts\Pattern::class, Services\Pattern::class);
$app->singleton(Contracts\Pipes::class, Services\Pipes::class);
$app->singleton(Contracts\Template::class, Services\Template::class);
$app->singleton(Contracts\Validation::class, Services\Validation::class);

return $app;
