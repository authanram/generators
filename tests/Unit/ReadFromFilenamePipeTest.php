<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Exceptions\ReadFromFilenamePipeFailureException as PipeException;
use Authanram\Generators\Pipes\ReadFromFilename as Pipe;
use Authanram\Generators\Tests\TestClasses\TestPassable as Passable;

function stub (): object {
    return (object)[
        'exists' => 'first.stub',
        'directory' => __DIR__.'/../stubs',
        'readable' => __DIR__.'/../stubs/test-not-readable.stub',
        'resolvable' => __DIR__.'/../stubs/test.stub',
    ];
}

beforeAll(function () {
    file_put_contents(stub()->readable, 'not-readable');
    chmod(stub()->readable, 0333);
});

afterAll(function () {
    unlink(stub()->readable);
});

beforeEach(function () {
    $this->next = fn ($passable) => $passable;
    $this->passable = fn (string $filename) => Passable::fromFilename($filename);
});

it('throws if {$filename} does not exist', function () {
    Pipe::handle(($this->passable)(stub()->exists), $this->next);
})->expectExceptionMessage((new PipeException(stub()->exists))->getMessage());

it('throws if {$filename} is a directory', function () {
    Pipe::handle(($this->passable)(stub()->directory), $this->next);
})->expectExceptionMessage(
    (new PipeException(stub()->directory, PipeException::DIRECTORY))
        ->getMessage(),
);

it('throws if {$filename} is not readable', function () {
    Pipe::handle(($this->passable)(stub()->readable), $this->next);
})->expectExceptionMessage(
    (new PipeException(stub()->readable, PipeException::READABLE))
        ->getMessage(),
);

it('resolves file contents', function () {
    $text = Pipe::handle(($this->passable)(stub()->resolvable), $this->next)
        ->getDescriptor()->getText();

    expect(rtrim($text, "\n"))->toBe('first {{ second }} third {{ fourth }}');
});
