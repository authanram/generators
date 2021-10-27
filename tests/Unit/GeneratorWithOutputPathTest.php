<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\Generator;
use Authanram\Generators\Input;

$withOutputPath = fn (string $outputPath) => Generator::make()
    ->withFillCallback(fn (Input $data) => [
        'second' => $data->str('second')->lower(),
        'fourth' => $data->str('fourth')->upper(),
    ])->withInput([
        'second' => '2nd',
        'fourth' => '4th',
    ])->withInputPath(
        __DIR__.'/../stubs/test.stub',
    )->withOutputPath(
        $outputPath,
    );

$outputPath = __DIR__.'/generator-result.txt';

beforeEach(function () use ($outputPath) {
    $this->outputPath = $outputPath;

    shell_exec('touch '.$this->outputPath);
});

afterEach(function () {
    @unlink($this->outputPath);
});

it('throws if outputPath is empty', function () use ($withOutputPath) {
    $withOutputPath('')->generate();
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$outputPath'));

it('throws if outputPath is not writeable', function () use ($withOutputPath) {
    shell_exec('chmod 444 '.$this->outputPath);

    $withOutputPath($this->outputPath)->generate();
})->expectExceptionMessage(Assert::message(Assert::WRITEABLE, $outputPath));

it('generates with outputPath', function () use ($withOutputPath) {
    $withOutputPath($this->outputPath)->generate();

    expect($this->outputPath)->toBeReadableFile();

    expect(file_get_contents($this->outputPath))->toBe('first 2nd third 4TH');
});
