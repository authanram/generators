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
    new Passable('', '', '', $this->markers);
})->expectExceptionMessage(Passable::$messageDescriptor);

it('throws if {$text} is empty', function () {
    new Passable(TestDescriptor::class, '', '', $this->markers);
})->expectExceptionMessage(Passable::$messageText);

it('throws if {$pattern} is empty'.Descriptor::class, function () {
    new Passable(TestDescriptor::class, 'text', '', $this->markers);
})->expectExceptionMessage(Passable::$messagePattern);

it('resolves all properties', function () {
    $markers = $this->markers;

    $passable = new Passable(
        TestDescriptor::class,
        'text',
        'pattern',
        $markers,
    );

    expect($passable)->toBeInstanceOf(Passable::class);
    expect($passable->descriptor)->toEqual(TestDescriptor::class);
    expect($passable->text)->toEqual('text');
    expect($passable->pattern)->toEqual('pattern');
    expect($passable->markers)->toBeInstanceOf(Markers::class);
});
