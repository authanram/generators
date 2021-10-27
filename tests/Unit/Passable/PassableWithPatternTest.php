<?php

declare(strict_types=1);

use Authanram\Generators\Assert;

it('throws if pattern is empty', function (): void {
    passable()->withPattern('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$pattern'));

it('throws if pattern is invalid', function (): void {
    passable()->withPattern('{{}}');
})->expectExceptionMessage(Assert::message(Assert::CONTAINS, '$pattern', '%s'));
