<?php

declare(strict_types=1);

use Authanram\Generators\Generator;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;
use Authanram\Generators\Tests\TestClasses\TestDescriptorWithPath;

it('generates', function () {
    $descriptor = Generator::make(new TestDescriptor)->generate(
        ['second' => '2nd', 'fourth' => '4th'],
        'first {{ second }} third {{ fourth }}',
    );

    expect($descriptor->getText())->toBe('first 2nd third 4th');
});

it('generates with custom pattern: !! %s ##', function () {
    $descriptor = Generator::make(new TestDescriptor('!! %s ##'))->generate(
        ['second' => '2nd', 'fourth' => '4th'],
        'first !! second ## third !! fourth ##',
    );

    expect($descriptor->getText())->toBe('first 2nd third 4th');
});

it('generates from path', function () {
    $result = Generator::make(new TestDescriptorWithPath)->generate(
        ['second' => '2nd', 'fourth' => '4th'],
    );

    $text = rtrim($result->getText(), "\n");

    expect($text)->toBe("first 2nd third 4th");
});
