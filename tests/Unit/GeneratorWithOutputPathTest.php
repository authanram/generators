<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\Generator;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;

$outputPath = __DIR__.'/generator-result.txt';

beforeEach(function () use ($outputPath) {
    $this->generator = Generator::make(TestDescriptor::class)
        ->withInput(['second' => '2nd', 'fourth' => '4th']);

    $this->outputPath = $outputPath;

    shell_exec('touch '.$this->outputPath);
});

afterEach(function () {
    @unlink($this->outputPath);
});

it('throws if outputPath is empty', function () {
    $this->generator
        ->withOutputPath('')
        ->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$outputPath'));

it('throws if outputPath is not writeable', function () {
    shell_exec('chmod 444 '.$this->outputPath);

    $this->generator
        ->withOutputPath($this->outputPath)
        ->generate();
})->expectExceptionMessage(Assert::message(Assert::WRITEABLE, $outputPath));

it('generates withOutputPath', function () {
    $this->generator
        ->withOutputPath($this->outputPath)
        ->generate();

    expect($this->outputPath)->toBeReadableFile();

    expect(file_get_contents($this->outputPath))->toBe('first 2nd third 4TH');
});
