<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Generator;
use Authanram\Generators\Pipes\Postprocess;

it('throws if pipes are empty', function (): void {
    generator(false)->withPipes([])->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$pipes'));

it('throws if pipes are not unique', function (): void {
    generator(false)
        ->withPipes(array_merge(Generator::PIPES, [Postprocess::class]))
        ->generate();
})->expectExceptionMessage(Assert::message(Assert::UNIQUE_VALUES, '$pipes'));

it('throws if pipe not implements contract', function (): void {
    generator(false)
        ->withPipes(array_merge(Generator::PIPES, [Generator::class]))
        ->generate();
})->expectExceptionMessage(Assert::message(
    Assert::IMPLEMENTS_INTERFACE,
    Generator::class,
    Pipe::class,
));

it('generates with pipes', function (): void {
    $template = generator(false)->withPipes(Generator::PIPES)
        ->generate()
        ->template();

    expect($template)->toBe('first 2nd third 4TH');
});
