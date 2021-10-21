<?php

declare(strict_types=1);

use Authanram\Generators\Contracts\Descriptor;
use Authanram\Generators\Contracts\Markers;
use Authanram\Generators\Passable;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;

beforeEach(function () {
    $this->markers = Mockery::spy(Markers::class);
});

it('throws if {$descriptor} is not a class', function () {
    Passable::make('', '', '', $this->markers);
})->expectExceptionMessage(Passable::$messageDescriptor);

it('throws if {$text} is empty', function () {
    Passable::make(TestDescriptor::class, '', '', $this->markers);
})->expectExceptionMessage(Passable::$messageText);

it('throws if {$pattern} is empty'.Descriptor::class, function () {
    Passable::make(TestDescriptor::class, 'text', '', $this->markers);
})->expectExceptionMessage(Passable::$messagePattern);

it('resolves all properties', function () {
    $markers = $this->markers;

    $passable = Passable::make(
        TestDescriptor::class,
        'text',
        'pattern',
        $markers,
    );

    expect($passable)->toBeInstanceOf(Passable::class);
    expect($passable->getDescriptor())->toEqual(TestDescriptor::class);
    expect($passable->getText())->toEqual('text');
    expect($passable->getPattern())->toEqual('pattern');
    expect($passable->getMarkers())->toBeInstanceOf(Markers::class);
    expect($passable->getMarkersResolved())->toBeInstanceOf(Markers::class);
});
