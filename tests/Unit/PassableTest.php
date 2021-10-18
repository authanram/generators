<?php

declare(strict_types=1);

use Authanram\Generators\Contracts\Markers;
use Authanram\Generators\Descriptor;
use Authanram\Generators\Passable;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;

beforeEach(function () {
    $this->markers = mock(Markers::class);
});

it('throws if {$descriptor} is not a class', function () {
    new Passable('', '', '', $this->markers);
})->expectExceptionMessage(Passable::$messageDescriptor);

it('throws if {$pattern} is not of type '.Descriptor::class, function () {
    new Passable(TestDescriptor::class, '', '', $this->markers);
})->expectExceptionMessage(Passable::$messagePattern);

it('throws if {$text} is empty', function () {
    new Passable(TestDescriptor::class, 'first', '', $this->markers);
})->expectExceptionMessage(Passable::$messageText);

it('resolves all properties', function () {
    $markers = $this->markers;

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
    expect($passable->markers)->toBeInstanceOf(MarkersContract::class);
});
