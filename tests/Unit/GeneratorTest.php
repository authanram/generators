<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Generator;
use Authanram\Generators\Tests\TestClasses;

beforeEach(function () {
    $this->input = ['second' => '2nd', 'fourth' => '4th'];
});

afterEach(function () {
    @unlink(__DIR__.'/filename.test');
});

it('generates', function () {
    $passable = Generator::make(TestClasses\TestDescriptor::class)
        ->withInput($this->input)
        ->generate();

    expect($passable->stub())->toBe('first 2nd third 4TH');
});

it('generates with filename', function () {
    $passable = Generator::make(TestClasses\TestDescriptorUsingStubFile::class)
        ->withFilename(__DIR__.'/filename.test')
        ->withInput($this->input)
        ->generate();

    expect($passable->stub())->toBe('first 2nd third 4TH');
});
