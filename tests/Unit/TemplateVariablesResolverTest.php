<?php

declare(strict_types=1);

use Authanram\Generators\TemplateVariablesResolver;

it('asserts argument $template is not empty', function () {
    TemplateVariablesResolver::resolve('', '');
})->expectExceptionMessage('{$template} must not be empty.');

it('asserts argument $pattern is not empty', function () {
    TemplateVariablesResolver::resolve('first', '');
})->expectExceptionMessage('{$pattern} must not be empty.');

it('asserts argument $pattern contains "%s"', function () {
    TemplateVariablesResolver::resolve('first', 'second');
})->expectExceptionMessage('{$pattern} must contain [%s].');

it('resolves variables', function () {
    $markers = TemplateVariablesResolver::resolve(
        'first {{ second }} third {{ fourth }}',
        '{{ %s }}',
    );

    expect($markers)->toEqual(['second', 'fourth']);
});
