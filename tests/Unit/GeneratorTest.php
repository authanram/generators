<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\Generator;
use Authanram\Generators\Input;

beforeEach(function() {
    $this->generator = Generator::make()
        ->withFillCallback(fn (Input $data) => [
            'second' => $data->str('second')->lower(),
            'fourth' => $data->str('fourth')->upper(),
        ])->withInputPath(
            __DIR__.'/../stubs/test.stub',
        );

    $this->input = ['second' => '2nd', 'fourth' => '4th'];
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

it('throws if pattern is empty', function () {
    $this->generator
        ->withInput($this->input)
        ->withPattern('')
        ->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$pattern'));

it('generates', function () {
    $passable = $this->generator
        ->withInput($this->input)
        ->generate();

    expect($passable->template())->toBe('first 2nd third 4TH');
});
