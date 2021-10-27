<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;

$outputPath = __DIR__.'/../../generator-result.txt';

afterEach(function () use ($outputPath): void {
    file_exists($outputPath) ? unlink($outputPath) : null;
});

it('throws if outputPath is empty', function (): void {
    generator()->withOutputPath('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$outputPath'));

it(
    'throws if outputPath is not writeable',
    function () use ($outputPath): void {
        shell_exec('install -m 444 /dev/null '.$outputPath);

        generator()->withOutputPath($outputPath);
    },
)->expectExceptionMessage(Assert::message(Assert::WRITEABLE, $outputPath));

it('generates with outputPath', function () use ($outputPath): void {
    generator(false)->withOutputPath($outputPath)->generate();

    expect($outputPath)->toBeReadableFile();

    expect(file_get_contents($outputPath))->toBe('first 2nd third 4TH');
});
