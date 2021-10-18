<?php

declare(strict_types=1);

use Authanram\Generators\Markers;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;

it('resolves all markers', function () {
    $data = ['second' => '2nd', 'fourth' => '4th'];
    $result = TestDescriptor::fill(Markers::make($data));

    expect($result)->toEqual($data);
    expect($result)->toHaveCount(2);
});
