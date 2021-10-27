<?php

declare(strict_types=1);

use Authanram\Generators\Descriptor;
use Authanram\Generators\Generator;
use Authanram\Generators\Input;
use Authanram\Generators\Passable;
use Authanram\Generators\Pipes;
use Mockery\Expectation;
use Mockery\ExpectationInterface;
use Mockery\HigherOrderMessage;
use Mockery\MockInterface;

/** @param array<string> $merge */
function __descriptor(
    array $merge = [],
): HigherOrderMessage|Expectation|MockInterface|ExpectationInterface {
    return mock(Descriptor::class)->allows(array_merge([
        'fill' => (__fillCallback())(new Input(__input())),
        'path' => __inputPath(),
        'pattern' => __pattern(),
    ], $merge));
}

function __fillCallback(): Closure
{
    /** @return array<string> */
    return static fn (Input $data) => [
        'second' => $data->str('second')->lower(),
        'fourth' => $data->str('fourth')->upper(),
    ];
}

/** @return array<string> */
function __input(): array
{
    return [
        'second' => '2nd',
        'fourth' => '4th',
    ];
}

function __install(
    int $chmod,
    string $path,
    bool $passable = false,
): Generator|Passable {
    shell_exec('install -m '.$chmod.' /dev/null '.$path);

    return $passable ? passable() : generator();
}

function __inputPath(bool $tmp = false): string
{
    return $tmp === false
        ? __DIR__.'/stubs/test.stub'
        : __DIR__.'/../../not-readable.stub';
}

function __inputPathWithPattern(): string
{
    return __DIR__.'/stubs/test-with-pattern.stub';
}

function __outputPath(): string
{
    return __DIR__.'/../../generator-result.txt';
}

function __pattern(): string
{
    return '{{ %s }}';
}

/**
 * @param array<string> $merge
 *
 * @return array<string>
 */
function __pipes(array $merge = []): array
{
    return array_merge([
        Pipes\ReadFromInputPath::class,
        Pipes\ResolveTemplateVariables::class,
        Pipes\ReplaceTemplateVariables::class,
        Pipes\Postprocess::class,
    ], $merge);
}

function generator(): Generator
{
    return Generator::make();
}

function passable(): Passable
{
    return new Passable();
}
