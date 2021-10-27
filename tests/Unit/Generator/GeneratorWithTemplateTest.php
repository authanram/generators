<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;

it('throws if templates is empty', function (): void {
    generator()->withTemplate('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$template'));

it('throws if template does not contain template variables', function (): void {
    generator()->withTemplate('first');
})->expectExceptionMessage(Assert::message(Assert::VARIABLE, '$template'));
