<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\Generator;
use Authanram\Generators\Tests\TestClasses\TestDescriptor as Descriptor;

$inputPath = __DIR__.'/filename.test';

$generator = function ($context) {
    return Generator::make(
        mock(Descriptor::class)->allows($context->allows),
    )->withInput($context->input);
};

beforeEach(function () use ($inputPath) {
    $this->input = ['second' => '2nd', 'fourth' => '4th'];

    $this->inputPath = $inputPath;

    $this->allows = [
        'fill' => $this->input,
        'path' => __DIR__.'/../stubs/test.stub',
        'pattern' => '{{ %s }}',
    ];

    shell_exec('touch '.$this->inputPath);
});

afterEach(function () {
    @unlink($this->inputPath);
});

it(
    'throws if input filled is not a key value map',
    function () use ($generator) {
        $this->allows['fill'] = [];

        $generator($this)->generate();
    },
)->expectExceptionMessage(
    Assert::message(Assert::RETURNS_NOT_EMPTY_MAP, 'fill()'),
);

it('throws if input path is empty', function () use ($generator) {
    $this->allows['path'] = '';

    $generator($this)->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$inputPath'));

it('throws if input path was not found', function () use ($generator) {
    $this->allows['path'] = 'first';

    $generator($this)->generate();
})->expectExceptionMessage(Assert::message(Assert::FILE_NOT_FOUND, 'first'));

it('throws if pattern is empty', function () use ($generator) {
    $this->allows['pattern'] = '';

    $generator($this)->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$pattern'));

it('throws if input path is not readable', function () use ($generator) {
    shell_exec('chmod 333 '.$this->inputPath);

    $this->allows['path'] = $this->inputPath;

    $generator($this)->generate();
})->expectExceptionMessage(Assert::message(Assert::READABLE, $inputPath));

it('throws if template is empty', function () use ($generator) {
    $this->allows['path'] = $this->inputPath;

    $generator($this)->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$template'));
