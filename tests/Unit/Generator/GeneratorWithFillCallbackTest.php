<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;

it('throws if fillCallback is empty', function (): void {
    generator()->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$fillCallback'));
