<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;

$path = __DIR__.'/../../stubs/not-writeable.stub';

beforeAll(function () use ($path) {
    chmod($path, 0444);
});

afterAll(function () use ($path) {
    chmod($path, 0755);
});

it('throws if outputPath is empty', function (): void {
    generator()->withOutputPath('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$outputPath'));

it('throws if outputPath is not writeable', function () use ($path): void {
    generator()->withOutputPath($path);
})->expectExceptionMessage(Assert::message(Assert::WRITEABLE, $path));
