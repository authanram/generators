<?php

declare(strict_types=1);

use Authanram\Generators\Markers;
use Authanram\Generators\Tests\TestClasses;

it('resolves pattern from descriptor', function () {
    $descriptor = new TestClasses\TestDescriptorWithPattern;

    expect($descriptor->getPattern())->toEqual($descriptor::pattern());
});

it('resolves pattern from argument', function () {
    $pattern = '!! %s ##';
    $descriptor = new TestClasses\TestDescriptorWithPattern($pattern);

    expect($descriptor->getPattern())->toEqual($pattern);
});

it('resolves all markers', function () {
    $data = ['second' => '2nd', 'fourth' => '4th'];
    $descriptor = TestClasses\TestDescriptor::fill(Markers::make($data));

    expect($descriptor)->toEqual($data);
    expect($descriptor)->toHaveCount(2);
});
