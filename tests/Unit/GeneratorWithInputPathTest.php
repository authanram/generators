<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\Generator;
use Authanram\Generators\Input;

$withInputPath = fn (string $inputPath) => Generator::make()
    ->withFillCallback(fn (Input $data) => [
        'second' => $data->str('second')->lower(),
        'fourth' => $data->str('fourth')->upper(),
    ])->withInput([
        'second' => '2nd',
        'fourth' => '4th',
    ])->withInputPath($inputPath);

$inputPath = __DIR__.'/not-readable.stub';

beforeEach(function () use ($inputPath) {
    $this->inputPath = $inputPath;
});

afterEach(function () {
    @unlink($this->inputPath);
});

it('throws if inputPath is empty', function () use ($withInputPath) {
    $withInputPath('')->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$inputPath'));

it('throws if inputPath is not readable', function () use ($withInputPath) {
    shell_exec('touch '.$this->inputPath);
    shell_exec('chmod 333 '.$this->inputPath);

    $withInputPath($this->inputPath)->generate();
})->expectExceptionMessage(Assert::message(Assert::READABLE, $inputPath));

it('generates with inputPath', function () use ($withInputPath) {
    $passable = $withInputPath(__DIR__.'/../stubs/test.stub')->generate();

    expect($passable->template())->toBe('first 2nd third 4TH');
});
