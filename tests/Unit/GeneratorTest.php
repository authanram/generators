<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

afterAll(function (): void {
    file_exists(__outputPath()) ? unlink(__outputPath()) : null;
});

it('generates', function (): void {
    $template = generator()
        ->withFillCallback(__fillCallback())
        ->withInput(__input())
        ->withPattern(__pattern())
        ->withInputPath(__inputPath())
        ->generate()
        ->template();

    expect($template)->toBe('first 2nd third 4TH');
});

it('generates withDescriptor', function (): void {
    $template = generator()
        ->withDescriptor(__descriptor())
        ->withInput(__input())
        ->generate()
        ->template();

    expect($template)->toBe('first 2nd third 4TH');
});

it('generates withInputPath', function (): void {
    $template = generator()
        ->withFillCallback(__fillCallback())
        ->withInput(__input())
        ->withInputPath(__inputPath())
        ->generate()
        ->template();

    expect($template)->toBe('first 2nd third 4TH');
});

it('generates withOutputPath', function (): void {
    generator()
        ->withFillCallback(__fillCallback())
        ->withInput(__input())
        ->withInputPath(__inputPath())
        ->withOutputPath(__outputPath())
        ->generate();

    expect(__outputPath())->toBeReadableFile();
    expect(file_get_contents(__outputPath()))->toBe('first 2nd third 4TH');
});

it('generates withPattern', function (): void {
    $template = generator()
        ->withFillCallback(__fillCallback())
        ->withInput(__input())
        ->withInputPath(__inputPathWithPattern())
        ->withPattern('!!1 %s 2##')
        ->generate()
        ->template();

    expect($template)->toBe('first 2nd third 4TH');
});

it('generates withPipes', function (): void {
    $template = generator()
        ->withFillCallback(__fillCallback())
        ->withInput(__input())
        ->withInputPath(__inputPath())
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
