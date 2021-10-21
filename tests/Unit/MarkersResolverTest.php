<?php

declare(strict_types=1);

use Authanram\Generators\MarkersResolver;
use Authanram\Generators\Pattern;

it('throws if {$stub} is empty', function () {
    MarkersResolver::resolve('', Pattern::make());
})->expectExceptionMessage(MarkersResolver::$messageText);

it('resolves all markers', function () {
    $markers = MarkersResolver::resolve(
        'first {{ second }} third {{ fourth }}',
        Pattern::make(),
    );

    expect($markers)->toHaveCount(2);
    expect($markers)->toEqual(['second', 'fourth']);
});

it('resolves all markers through a custom pattern', function () {
    $markers = MarkersResolver::resolve(
        'first !! 2nd ## third !! 4th ##',
        Pattern::make('!! %s ##'),
    );

    expect($markers)->toHaveCount(2);
    expect($markers)->toEqual(['2nd', '4th']);
});
