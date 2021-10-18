<?php

declare(strict_types=1);

use Authanram\Generators\MarkersResolver;

it('throws if {$stub} is empty', function () {
    MarkersResolver::resolve('');
})->expectExceptionMessage(MarkersResolver::$messageText);

it('throws if {$pattern} is empty', function () {
    MarkersResolver::resolve('first', '');
})->expectExceptionMessage(MarkersResolver::$messagePatternEmpty);

it('throws if {$pattern} is invalid', function () {
    MarkersResolver::resolve('first', 'second');
})->expectExceptionMessage(MarkersResolver::$messagePatternInvalid);

it('resolves all markers', function () {
    $markers = MarkersResolver::resolve(
        'first {{ second }} third {{ fourth }}',
    );

    expect($markers)->toHaveCount(2);
    expect($markers)->toEqual(['second', 'fourth']);
});

it('resolves all markers through a custom pattern', function () {
    $markers = MarkersResolver::resolve(
        'first !! 2nd ## third !! 4th ##',
        '!! %s ##',
    );

    expect($markers)->toHaveCount(2);
    expect($markers)->toEqual(['2nd', '4th']);
});
