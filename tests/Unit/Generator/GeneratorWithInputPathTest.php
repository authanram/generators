<?php

declare(strict_types=1);

use Authanram\Generators\Assert;

$path = __DIR__.'/../../stubs/not-readable.stub';

beforeAll(function () use ($path): void {
    touch($path);
    chmod($path, 0333);
});

afterAll(function () use ($path): void {
    unlink($path);
});

it('throws if inputPath is empty', function (): void {
    generator()->withInputPath('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$inputPath'));

it('throws if inputPath was not found', function (): void {
    generator()->withInputPath('first');
})->expectExceptionMessage(Assert::message(Assert::FILE_NOT_FOUND, 'first'));

it('throws if inputPath is not readable', function () use ($path): void {
    generator()->withInputPath($path);
})->expectExceptionMessage(Assert::message(Assert::READABLE, $path));
