<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Generator;
use Authanram\Generators\Pattern;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;
use Authanram\Generators\Tests\TestClasses\TestDescriptorWithFilename;

it('generates', function () {
    $descriptor = Generator::make(new TestDescriptor)
        ->generate(
            ['second' => '2nd', 'fourth' => '4th'],
            'first {{ second }} third {{ fourth }}',
        );

    expect($descriptor->text())->toBe('first 2nd third 4th');
});

it('generates from argument {$filename}', function () {
    $descriptor = Generator::make(new TestDescriptorWithFilename())
        ->generate(['second' => '2nd', 'fourth' => '4th']);

    $text = rtrim($descriptor->text(), "\n");

    expect($text)->toBe("first 2nd third 4th");
});

it('generates from argument {$filename} with {$pattern}', function () {
    $descriptor = Generator::make(
        (new TestDescriptor)
            ->withFilename(__DIR__.'/../stubs/test-with-pattern.stub')
            ->withPattern(Pattern::make('!! %s ##')),
    )->generate(['second' => '2nd', 'fourth' => '4th']);

    $text = rtrim($descriptor->text(), "\n");

    expect($text)->toBe("first 2nd third 4th");
});
