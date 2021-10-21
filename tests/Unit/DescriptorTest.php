<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Markers;
use Authanram\Generators\Pattern;
use Authanram\Generators\Tests\TestClasses;

it('resolves pattern through descriptor', function () {
    $descriptor = new TestClasses\TestDescriptorWithPattern;
    $pattern = $descriptor->pattern()->phrase();

    expect($pattern)->toEqual($descriptor::phrase());
});

it('resolves pattern through argument', function () {
    $pattern = Pattern::make('!! %s ##');
    $descriptor = new TestClasses\TestDescriptorWithPattern($pattern);

    expect($descriptor->pattern())->toEqual($pattern);
});

it('resolves all markers', function () {
    $data = ['second' => '2nd', 'fourth' => '4th'];
    $descriptor = TestClasses\TestDescriptor::fill(Markers::make($data));

    expect($descriptor)->toEqual($data);
    expect($descriptor)->toHaveCount(2);
});
