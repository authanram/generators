<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Exceptions\InvalidArgumentException;
use Authanram\Generators\Exceptions\MustImplementInterfaceException;
use Authanram\Generators\Passable;
use Authanram\Generators\Pipeline;
use Illuminate\Container\Container;

it('throws if argument {$pipes} are empty', function () {
    Pipeline::handle(new Passable, [], new Container());
})->expectExceptionMessage(
    (new InvalidArgumentException('$pipes'))->getMessage(),
);

it('throws if argument {$pipes} contains classes without a suitable contract', function () {
    Pipeline::handle(new Passable, [Pipeline::class], new Container());
})->expectExceptionMessage(
    (new MustImplementInterfaceException(Pipeline::class, Pipe::class))
        ->getMessage(),
);
