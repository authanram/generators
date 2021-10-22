<?php

declare(strict_types=1);

use Authanram\Generators\Container;
use Authanram\Generators\Contracts\Services as Contracts;
use Authanram\Generators\Services;
use Illuminate\Support\Facades\Facade;

$app = new Container();

$app->singleton('app', Container::class);

/** @noinspection PhpParamsInspection */
Facade::setFacadeApplication($app);

$app->singleton(Contracts\FileReader::class, Services\FileReader::class);
$app->singleton(Contracts\FileWriter::class, Services\FileWriter::class);
$app->singleton(Contracts\Input::class, Services\Input::class);
$app->singleton(Contracts\Pattern::class, Services\Pattern::class);
$app->singleton(Contracts\Pipes::class, Services\Pipes::class);
$app->singleton(Contracts\Template::class, Services\Template::class);

return $app;
