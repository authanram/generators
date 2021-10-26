<?php

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\TemplateVariablesResolver;

it('throws if template is empty', function () {
    TemplateVariablesResolver::resolve('', '');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$template'));

it('throws if pattern is empty', function () {
    TemplateVariablesResolver::resolve('first', '');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$pattern'));

it('throws if pattern is invalid', function () {
    TemplateVariablesResolver::resolve('first', 'second');
})->expectExceptionMessage(Assert::message(Assert::CONTAINS, '$pattern', '%s'));

it('resolves variables', function () {
    $markers = TemplateVariablesResolver::resolve(
        'first {{ second }} third {{ fourth }}',
        '{{ %s }}',
    );

    expect($markers)->toEqual(['second', 'fourth']);
});
