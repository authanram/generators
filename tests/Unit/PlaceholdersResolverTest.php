<?php

declare(strict_types=1);

use Authanram\Generators\Resolvers\PlaceholdersResolver;

it('asserts argument $text is not empty', function () {
    PlaceholdersResolver::resolve('', '');
})->expectExceptionMessage('$text must not be empty.');

it('asserts argument $pattern is not empty', function () {
    PlaceholdersResolver::resolve('first', '');
})->expectExceptionMessage('$pattern must not be empty.');

it('asserts argument $pattern contains "%s"', function () {
    PlaceholdersResolver::resolve('first', 'second');
})->expectExceptionMessage('$pattern must contain "%s".');

it('resolves placeholders', function () {
    $markers = PlaceholdersResolver::resolve(
        'first {{ second }} third {{ fourth }}',
        '{{ %s }}',
    );

    expect($markers)->toEqual(['second', 'fourth']);
});
