<?php

declare(strict_types=1);

use Authanram\Generators\Assert;

$inputPath = __DIR__.'/../../filename.test';

afterEach(function () use ($inputPath): void {
    file_exists($inputPath) ? unlink($inputPath) : null;
});

it('throws if input is empty', function (): void {
    passable()->withInput([]);
})->expectExceptionMessage(
    Assert::message(Assert::NOT_EMPTY, '$input'),
);

it('throws if input path is empty', function (): void {
    passable()->withInputPath('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$inputPath'));

it('throws if input path was not found', function (): void {
    passable()->withInputPath('first');
})->expectExceptionMessage(Assert::message(Assert::FILE_NOT_FOUND, 'first'));

it('throws if pattern is empty', function (): void {
    passable()->withPattern('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$pattern'));

it('throws if pattern is invalid', function (): void {
    passable()->withPattern('{{}}');
})->expectExceptionMessage(Assert::message(Assert::CONTAINS, '$pattern', '%s'));

it(
    'throws if input path is not readable',
    function () use ($inputPath): void {
        shell_exec('install -m 333 /dev/null '.$inputPath);

        passable()->withInputPath($inputPath);
    },
)->expectExceptionMessage(Assert::message(Assert::READABLE, $inputPath));

it('throws if template is empty', function (): void {
    passable()->withTemplate('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$template'));
