<?php

declare(strict_types=1);

use Authanram\Generators\Assert;

afterAll(function (): void {
    file_exists(__inputPath(true)) ? unlink(__inputPath(true)) : null;
});

it('throws if inputPath is empty', function (): void {
    passable()->withInputPath('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$inputPath'));

it('throws if inputPath was not found', function (): void {
    passable()->withInputPath('first');
})->expectExceptionMessage(Assert::message(Assert::FILE_NOT_FOUND, 'first'));

it('throws if inputPath is not readable', function (): void {
    __install(333, __inputPath(true), true)->withInputPath(__inputPath(true));
})->expectExceptionMessage(
    Assert::message(Assert::READABLE, __inputPath(true)),
);
