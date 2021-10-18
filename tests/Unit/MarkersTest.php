<?php

declare(strict_types=1);

use Authanram\Generators\Markers;

it('throws if {$items} is not assoc', function () {
    Markers::make(['first']);
})->expectExceptionMessage(sprintf(Markers::$messageMarkerKey, '0'));

it('throws if {$items} are not callable|string', function () {
    Markers::make([
        'first' => fn () => null,
        'second' => 0,
        'third' => '3rd',
    ]);
})->expectExceptionMessage(sprintf(Markers::$messageMarkerValue, 'second', '0'));

it('resolves all items', function () {
    $markers = Markers::make([
        'first' => fn () => null,
        'second' => '2nd',
    ])->toCollection();

    expect($markers->get('first'))->toBeCallable();
    expect($markers->get('second'))->toEqual('2nd');
    expect($markers)->toHaveCount(2);
});
