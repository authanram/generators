<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Exceptions\MarkerResolutionFailureException;
use Authanram\Generators\Markers;

it('throws if argument {$marker} does not match any known marker', function () {
    Markers::make(['first' => 'first'])->get('second');
})->expectExceptionMessage(
    (new MarkerResolutionFailureException('second'))->getMessage(),
);

it('resolves all markers', function () {
    $markers = Markers::make([
        'first' => fn () => null,
        'second' => '2nd',
        'third' => '3nd',
    ]);

    expect($markers->get('first'))->toBeCallable();
    expect($markers->get('second'))->toEqual('2nd');
    expect($markers->getItems())->toHaveCount(3);
});
