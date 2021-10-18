<?php

declare(strict_types=1);

use Authanram\Generators\Markers;
use Authanram\Generators\Passable;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;

it('throws if {$descriptor} is not a class', function () {
    new Passable('', '', '', Markers::make([], true));
})->expectExceptionMessage(Passable::$messageDescriptor);

it('throws if {$pattern} is not a class', function () {
    new Passable(TestDescriptor::class, '', '', Markers::make([], true));
})->expectExceptionMessage(Passable::$messagePattern);

it('throws if {$text} is empty', function () {
    new Passable(TestDescriptor::class, 'first', '', Markers::make([], true));
})->expectExceptionMessage(Passable::$messageText);

it('resolves all properties', function () {
    $markers = Markers::make([], true);

    $passable = new Passable(
        TestDescriptor::class,
        'pattern',
        'text',
        $markers,
    );

    expect($passable)->toBeInstanceOf(Passable::class);
    expect($passable->descriptor)->toEqual(TestDescriptor::class);
    expect($passable->pattern)->toEqual('pattern');
    expect($passable->text)->toEqual('text');
    expect($passable->markers)->toBeInstanceOf(Markers::class);
});
