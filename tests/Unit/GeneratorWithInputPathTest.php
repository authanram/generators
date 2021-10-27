<?php

declare(strict_types=1);

use Authanram\Generators\Assert;

$inputPath = __DIR__.'/../../not-readable.stub';

afterAll(function () use ($inputPath): void {
    file_exists($inputPath) ? unlink($inputPath) : null;
});

it('throws if inputPath is empty', function (): void {
    generator()->withInputPath('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$inputPath'));

it(
    'throws if inputPath is not readable',
    function () use ($inputPath): void {
        shell_exec('install -m 333 /dev/null '.$inputPath);

        generator()->withInputPath($inputPath);
    },
)->expectExceptionMessage(Assert::message(Assert::READABLE, $inputPath));

it('generates with inputPath', function (): void {
    expect(generator()->template())->toBe('first 2nd third 4TH');
});
