<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;

it('throws if input is empty', function (): void {
    generator()->withInput([]);
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$input'));

it('throws if input is not a key value map', function (): void {
    generator()->withInput(['first', 'second']);
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY_MAP, '$input'));

it('throws if input key not exists', function (): void {
    generator(false)->withInput(['second' => '2nd'])->generate();
})->expectExceptionMessage(Assert::message(Assert::KEY_EXISTS, 'fourth'));

it('generates with descriptor', function (): void {
    expect(generator()->withInput([
        'second' => '2nd',
        'fourth' => '4th',
    ])->template())->toBe('first 2nd third 4TH');
});
