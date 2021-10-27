<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;

it('throws if pattern is empty', function (): void {
    generator()->withPattern('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$pattern'));

it('throws if pattern is invalid', function (): void {
    generator()->withPattern('{{}}');
})->expectExceptionMessage(Assert::message(Assert::CONTAINS, '$pattern', '%s'));

it('throws if pattern is too short', function (): void {
    generator()->withPattern('{{%s}}');
})->expectExceptionMessage(Assert::message(Assert::LENGTH, '$pattern', 8));
