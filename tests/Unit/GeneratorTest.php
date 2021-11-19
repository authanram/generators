<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Tests\TestClasses;

$inputPath = __DIR__.'/../stubs/test.stub';
$outputPath = __DIR__.'/result.txt';

beforeEach(function () use ($inputPath): void {
    $this->inputPath = $inputPath;
});

it('generates', function (): void {
    $template = generator()
        ->withFillCallback(__fillCallback())
        ->withInput(__input())
        ->withPattern(__pattern())
        ->withInputPath($this->inputPath)
        ->generate()
        ->template();

    expect($template)->toBe('first 2nd third 4TH');
});

it('generates withDescriptor', function (): void {
    $template = generator()
        ->withDescriptor(TestClasses\TestDescriptorA::class)
        ->withInput(__input())
        ->generate()
        ->template();

    expect($template)->toBe('first 2nd third 4th');
});

it('generates withInputPath', function (): void {
    $template = generator()
        ->withFillCallback(__fillCallback())
        ->withInput(__input())
        ->withInputPath($this->inputPath)
        ->generate()
        ->template();

    expect($template)->toBe('first 2nd third 4TH');
});

it('generates withOutputPath', function () use ($outputPath): void {
    generator()
        ->withFillCallback(__fillCallback())
        ->withInput(__input())
        ->withInputPath($this->inputPath)
        ->withOutputPath($outputPath)
        ->generate();

    expect($outputPath)->toBeReadableFile();
    expect(file_get_contents($outputPath))->toBe('first 2nd third 4TH');
    unlink($outputPath);
});

it('generates withPattern', function (): void {
    $template = generator()
        ->withFillCallback(__fillCallback())
        ->withInput(__input())
        ->withInputPath(__DIR__.'/../stubs/test-with-pattern.stub')
        ->withPattern('!!1 %s 2##')
        ->generate()
        ->template();

    expect($template)->toBe('first 2nd third 4TH');
});

it('generates withPipes', function (): void {
    $template = generator()
        ->withFillCallback(__fillCallback())
        ->withInput(__input())
        ->withInputPath($this->inputPath)
        ->withPipes(__pipes())
        ->generate()
        ->template();

    expect($template)->toBe('first 2nd third 4TH');
});

it('generates withTemplate', function (): void {
    $template = generator()
        ->withFillCallback(__fillCallback())
        ->withInput(__input())
        ->withTemplate('first {{ second }} third {{ fourth }}')
        ->generate()
        ->template();

    expect($template)->toBe('first 2nd third 4TH');
});
