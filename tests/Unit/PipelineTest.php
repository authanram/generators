<?php

declare(strict_types=1);

use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Passable;
use Authanram\Generators\Pipeline;

it('throws if {$pipes} are empty', function () {
    Pipeline::handle(new Passable, []);
})->expectExceptionMessage(Pipeline::$messagePipes);

it('throws if {$pipes} contains an entry not implementing '. Pipe::class, function () {
    Pipeline::handle(new Passable, [Pipeline::class]);
})->expectExceptionMessage(sprintf(Pipeline::$messagePipe, Pipeline::class));
