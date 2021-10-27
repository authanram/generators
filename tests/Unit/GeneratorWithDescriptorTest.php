<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\Generator;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;

beforeEach(function () {
    $this->generator = Generator::make(TestDescriptor::class);
});

it('throws if input is empty', function () {
    $this->generator
        ->withInput([])
        ->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$input'));

it('throws if input is not a key value map', function () {
    $this->generator
        ->withInput(['first', 'second'])
        ->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY_MAP, '$input'));

it('throws if input key not exists', function () {
    $this->generator
        ->withInput(['second' => '2nd', 'third' => '3rd'])
        ->generate();
})->expectExceptionMessage(Assert::message(Assert::KEY_EXISTS, 'fourth'));

it('generates with descriptor', function () {
    $passable = $this->generator
        ->withInput(['second' => '2nd', 'fourth' => '4th'])
        ->generate();

    expect($passable->template())->toBe('first 2nd third 4TH');
});
