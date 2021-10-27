<?php

declare(strict_types=1);

use Authanram\Generators\Assert;

afterAll(function (): void {
    file_exists(__outputPath()) ? unlink(__outputPath()) : null;
});

it('throws if outputPath is empty', function (): void {
    passable()->withOutputPath('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$outputPath'));

it('throws if outputPath is not writeable', function (): void {
    __install(444, __outputPath(), true)->withOutputPath(__outputPath());
})->expectExceptionMessage(Assert::message(Assert::WRITEABLE, __outputPath()));
