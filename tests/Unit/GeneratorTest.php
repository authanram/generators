<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Generator;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;

afterEach(function () {
    @unlink(__DIR__.'/filename.test');
});

it('throws if input is empty', function () {
    Generator::make(TestDescriptor::class)
        ->withInput([])
        ->generate();
})->expectExceptionMessage('{$input} must not be empty.');

it('throws if input is not assoc', function () {
    Generator::make(TestDescriptor::class)
        ->withInput(['first', 'second'])
        ->generate();
})->expectExceptionMessage('{$input} must be a non empty key value map.');

it('throws if input path is empty', function () {
    $descriptor = mock(TestDescriptor::class)->allows([
        'fill' => fn ($data) => TestDescriptor::fill($data),
        'path' => '',
        'pattern' => '{{ %s }}',
    ]);

    Generator::make($descriptor)
        ->withInput(['first', 'second'])
        ->generate();
})->expectExceptionMessage('{$inputPath} must not be empty.');

it('throws if input path has not been found', function () {
    $descriptor = mock(TestDescriptor::class)->allows([
        'fill' => fn ($data) => TestDescriptor::fill($data),
        'path' => 'first',
        'pattern' => '{{ %s }}',
    ]);

    Generator::make($descriptor)
        ->withInput(['first', 'second'])
        ->generate();
})->expectExceptionMessage('File [first] not found.');

it('throws if pattern is empty', function () {
    $descriptor = mock(TestDescriptor::class)->allows([
        'fill' => fn ($data) => TestDescriptor::fill($data),
        'path' => __DIR__.'/../stubs/test.stub',
        'pattern' => '',
    ]);

    Generator::make($descriptor)
        ->withInput(['first', 'second'])
        ->generate();
})->expectExceptionMessage('{$pattern} must not be empty.');

it('generates', function () {
    $passable = Generator::make(TestDescriptor::class)
        ->withInput(['second' => '2nd', 'fourth' => '4th'])
        ->generate();

    expect($passable->template())->toBe('first 2nd third 4TH');
});
