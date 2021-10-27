<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Generator;
use Authanram\Generators\Pipes;

it('throws if pipes are empty', function (): void {
    generator()->withPipes([]);
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$pipes'));

it('throws if pipes are not unique', function (): void {
    generator()->withPipes(__pipes([Pipes\ReadFromInputPath::class]));
})->expectExceptionMessage(Assert::message(Assert::UNIQUE_VALUES, '$pipes'));

it('throws if pipe not implements contract', function (): void {
    generator()->withPipes([Generator::class])->generate();
})->expectExceptionMessage(Assert::message(
    Assert::IMPLEMENTS_INTERFACE,
    Generator::class,
    Pipe::class,
));
