<?php

declare(strict_types=1);

use Authanram\Generators\Assert;

it('throws if input is empty', function (): void {
    passable()->withInput([]);
})->expectExceptionMessage(
    Assert::message(Assert::NOT_EMPTY, '$input'),
);

it('throws if input is not a key value map', function (): void {
    passable()->withInput(['first', 'second']);
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY_MAP, '$input'));
