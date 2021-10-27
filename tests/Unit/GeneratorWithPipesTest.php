<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Generator;
use Authanram\Generators\Input;
use Authanram\Generators\Pipes\Postprocess;

$withPipes = function (array $extraPipes = [], array $pipes = null) {
    return Generator::make()
        ->withFillCallback(fn (Input $data) => [
            'second' => $data->str('second')->lower(),
            'fourth' => $data->str('fourth')->upper(),
        ])->withInput([
            'second' => '2nd',
            'fourth' => '4th',
        ])->withInputPath(
            __DIR__.'/../stubs/test.stub',
        )->withPipes(array_merge(
            $pipes ?? Generator::PIPES,
            $extraPipes,
        ));
};

it('throws if pipes are empty', function () use ($withPipes) {
    $withPipes([], [])->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$pipes'));

it('throws if pipes are not unique', function () use ($withPipes) {
    $withPipes([Postprocess::class])->generate();
})->expectExceptionMessage(Assert::message(Assert::UNIQUE_VALUES, '$pipes'));

it('throws if pipe not implements contract', function () use ($withPipes) {
    $withPipes([Generator::class])->generate();
})->expectExceptionMessage(Assert::message(
    Assert::IMPLEMENTS_INTERFACE,
    Generator::class,
    Pipe::class,
));

it('generates with pipes', function () use ($withPipes) {
    expect($withPipes()->generate()->template())->toBe('first 2nd third 4TH');
});
