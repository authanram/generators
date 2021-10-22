<?php

declare(strict_types=1);

use Authanram\Generators\Contracts\Services as Contracts;
use Authanram\Generators\Services;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Loader;
use Illuminate\Support\Facades\Facade;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

$app = app();

$app->singleton('app', Application::class);

$app->bind(Loader::class, ArrayLoader::class);

/** @noinspection PhpUnhandledExceptionInspection */
$translationLoader = $app->make(Loader::class);

$app->instance('translator', new Translator($translationLoader, 'en'));

$app->singleton('validator', fn ($app) => new Factory(
    $app['translator'],
    $app,
));

Facade::setFacadeApplication($app);

$app->singleton(Contracts\FileReader::class, Services\FileReader::class);
$app->singleton(Contracts\FileWriter::class, Services\FileWriter::class);
$app->singleton(Contracts\Input::class, Services\Input::class);
$app->singleton(Contracts\Pattern::class, Services\Pattern::class);
$app->singleton(Contracts\Pipes::class, Services\Pipes::class);
$app->singleton(Contracts\Template::class, Services\Template::class);
$app->singleton(Contracts\Validation::class, Services\Validation::class);

$app->alias(Contracts\FileReader::class, 'file.reader');
$app->alias(Contracts\FileWriter::class, 'file.writer');
$app->alias(Contracts\Input::class, 'input');
$app->alias(Contracts\Pattern::class, 'pattern');
$app->alias(Contracts\Pipes::class, 'pipes');
$app->alias(Contracts\Template::class, 'template');
$app->alias(Contracts\Validation::class, 'validation');

return $app;
