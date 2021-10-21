<?php

declare(strict_types=1);

use Authanram\Generators\Passable;
use Authanram\Generators\Pipes\ReadFromFilename;
use Authanram\Generators\Tests\TestClasses;

beforeEach(function () {
    $this->descriptor = new TestClasses\TestDescriptor();
    $this->next = fn ($passable) => $passable;
});

it('throws if {$filename} does not exist', function () {
    $this->descriptor->setFilename('first.stub');
    ReadFromFilename::handle(Passable::make($this->descriptor), $this->next);
})->expectExceptionMessage(
    sprintf(ReadFromFilename::$messageDoesNotExist, 'first.stub'),
);

it('throws if {$filename} is a directory', function () {
    $this->descriptor->setFilename(__DIR__.'/../stubs');
    ReadFromFilename::handle(Passable::make($this->descriptor), $this->next);
})->expectExceptionMessage(
    sprintf(ReadFromFilename::$messageMustNotBeADirectory, __DIR__.'/../stubs'),
);

it('resolves file contents', function () {
    $passable = Passable::make(new TestClasses\TestDescriptorWithFilename);
    $descriptor = ReadFromFilename::handle($passable, $this->next)->getDescriptor();
    $text = rtrim($descriptor->getText(), "\n");

    expect($text)->toBe('first {{ second }} third {{ fourth }}');
});
