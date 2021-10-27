<?php

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\TemplateVariablesResolver as Resolver;

it('throws if template is empty', function (): void {
    Resolver::resolve('', '');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$template'));

it('throws if pattern is empty', function (): void {
    Resolver::resolve('first', '');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$pattern'));

it('throws if pattern is invalid', function (): void {
    Resolver::resolve('first', 'second');
})->expectExceptionMessage(Assert::message(Assert::CONTAINS, '$pattern', '%s'));

it('resolves variables', function (): void {
    $variables = Resolver::resolve('1st {{ 2nd }} 3rd {{ 4th }}', '{{ %s }}');

    expect($variables)->toEqual(['2nd', '4th']);
});
