<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Generator;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;

it('throws if input is empty', function () {
    Generator::make(TestDescriptor::class)
        ->withInput([])
        ->generate();
})->expectExceptionMessage('{$input} must not be empty.');

it('throws if input is not a key value map', function () {
    Generator::make(TestDescriptor::class)
        ->withInput(['first', 'second'])
        ->generate();
})->expectExceptionMessage('{$input} must be a non empty key value map.');

it('generates', function () {
    $passable = Generator::make(TestDescriptor::class)
        ->withInput(['second' => '2nd', 'fourth' => '4th'])
        ->generate();

    expect($passable->template())->toBe('first 2nd third 4TH');
});
