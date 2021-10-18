<?php

declare(strict_types=1);

use Authanram\Generators\Descriptor;
use Authanram\Generators\Pipes;
use Authanram\Generators\Tests\TestClasses\OtherTestDescriptor;
use Authanram\Generators\Generator;

it('throws if descriptor is not of expected type', function () {
    new Generator('', ['foo' => 'bar']);
})->expectExceptionMessage('Argument {$descriptor} must be subclass of '. Descriptor::class);

it('throws if pipes are empty', function () {
    new Generator(Descriptor::class, []);
})->expectExceptionMessage('Argument {$pipes} must not be empty.');

it('throws if stub is empty', function () {
    (new Generator(Descriptor::class, ['foo' => 'bar']))
        ->generate('', []);
})->expectExceptionMessage('Argument {$stub} must not be empty.');

it('throws if markers are empty', function () {
    (new Generator(Descriptor::class, ['foo' => 'bar']))
        ->generate('foo', []);
})->expectExceptionMessage('Argument {$markers} must not be empty.');

it('throws if markers are not assoc', function () {
    (new Generator(Descriptor::class, ['foo' => 'bar']))
        ->generate('foo', ['foo']);
})->expectExceptionMessage('Argument {$markers} must only contain keys of type "string".');

it('throws if a marker is not callable or string', function () {
    (new Generator(Descriptor::class, ['foo' => 'bar']))
        ->generate('foo', ['foo' => 0]);
})->expectExceptionMessage('Argument {$markers} must only contain values of type "callable|string".');

it('generates', function () {
    (new Generator(OtherTestDescriptor::class, [
        Pipes\ResolveMarkers::class,
        Pipes\ExecuteFillCallback::class,
    ]))->generate('123', ['foo' => 'bar']);

    expect(true)->toBeTrue();
});
