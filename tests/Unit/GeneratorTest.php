<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\Generator;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;

it('throws if input is empty', function () {
    Generator::make(TestDescriptor::class)
        ->withInput([])
        ->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$input'));

it('throws if input is not a key value map', function () {
    Generator::make(TestDescriptor::class)
        ->withInput(['first', 'second'])
        ->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY_MAP, '$input'));

it('throws if input key not exists', function () {
    Generator::make(TestDescriptor::class)
        ->withInput(['second' => '2nd', 'third' => '3rd'])
        ->generate();
})->expectExceptionMessage(Assert::message(Assert::KEY_EXISTS, 'fourth'));

it('generates', function () {
    $passable = Generator::make(TestDescriptor::class)
        ->withInput(['second' => '2nd', 'fourth' => '4th'])
        ->generate();

    expect($passable->template())->toBe('first 2nd third 4TH');
});
