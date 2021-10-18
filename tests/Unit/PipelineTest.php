<?php

declare(strict_types=1);

use Authanram\Generators\Markers;
use Authanram\Generators\Passable;
use Authanram\Generators\Pipe;
use Authanram\Generators\Pipeline;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;

it('throws if pipes are empty', function () {
    $markers = Markers::make([], true);

    $passable = new Passable(
        TestDescriptor::class,
        'pattern',
        'text',
        $markers,
    );

    Pipeline::handle($passable, []);
})->expectExceptionMessage(Pipeline::$messagePipes);

it('throws if {$items} contains entries not implementing '. Pipe::class, function () {
    $markers = Markers::make([], true);

    $passable = new Passable(
        TestDescriptor::class,
        'pattern',
        'text',
        $markers,
    );

    Pipeline::handle($passable, [Pipeline::class]);
})->expectExceptionMessage(sprintf(Pipeline::$messagePipe, Pipeline::class));
