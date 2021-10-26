<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Generator;
use Authanram\Generators\Pipes;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;

beforeEach(function () {
    $this->generator = Generator::make(TestDescriptor::class)
        ->withInput(['second' => '2nd', 'fourth' => '4th']);

    $this->pipes = [
        Pipes\ReadFromInputPath::class,
        Pipes\ResolveTemplateVariables::class,
        Pipes\ReplaceTemplateVariables::class,
        Pipes\Postprocess::class,
    ];
});

it('throws if pipes are empty', function () {
    $this->generator->withPipes([])->generate();
})->expectExceptionMessage('{$pipes} must not be empty.');

it('throws if pipes are not unique', function () {
    $this->pipes[] = Pipes\Postprocess::class;

    $this->generator->withPipes($this->pipes)->generate();
})->expectExceptionMessage('{$pipes} must have unique values.');

it('throws if pipe does not implement required contract', function () {
    $this->pipes[] = Generator::class;

    $this->generator->withPipes($this->pipes)->generate();
})->expectExceptionMessage(sprintf(
    '[%s] must implement [%s].',
    Generator::class,
    Pipe::class,
));

it('generates withPipes', function () {
    $passable = $this->generator->withPipes($this->pipes)->generate();

    expect($passable->template())->toBe('first 2nd third 4TH');
});
