<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\Descriptor;

it('throws if descriptor is empty', function (): void {
    generator()->withDescriptor('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$descriptor'));

it('throws if descriptor is invalid', function (): void {
    generator()->withDescriptor(Assert::class);
})->expectExceptionMessage(
    Assert::message(Assert::SUBCLASS_OF, Assert::class, Descriptor::class),
);

it('throws if fillCallback result is empty', function (): void {
    generator()->withDescriptor(__descriptor(['fill' => []]))->generate();
})->expectExceptionMessage(
    Assert::message(Assert::RETURNS_NOT_EMPTY_MAP, 'fill()'),
);
