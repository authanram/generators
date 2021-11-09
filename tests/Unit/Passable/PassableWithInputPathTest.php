<?php

declare(strict_types=1);

use Authanram\Generators\Assert;

$path = __DIR__.'/../../stubs/not-readable.stub';

beforeAll(function () use ($path) {
    chmod($path, 0333);
});

afterAll(function () use ($path) {
    chmod($path, 0755);
});

it('throws if inputPath is empty', function (): void {
    passable()->withInputPath('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$inputPath'));

it('throws if inputPath was not found', function (): void {
    passable()->withInputPath('first');
})->expectExceptionMessage(Assert::message(Assert::FILE_NOT_FOUND, 'first'));

it('throws if inputPath is not readable', function () use ($path): void {
    passable()->withInputPath($path);
})->expectExceptionMessage(Assert::message(Assert::READABLE, $path));
