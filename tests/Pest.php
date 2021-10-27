<?php

declare(strict_types=1);

use Authanram\Generators\Generator;
use Authanram\Generators\Input;
use Authanram\Generators\Passable;

/** @noinspection PhpUnhandledExceptionInspection */
function generator(bool $generate = true): Generator|Passable
{
    $generator = Generator::make()
        ->withFillCallback(static fn (Input $data) => [
            'second' => $data->str('second')->lower(),
            'fourth' => $data->str('fourth')->upper(),
        ])->withInput([
            'second' => '2nd',
            'fourth' => '4th',
        ])->withInputPath(
            __DIR__.'/stubs/test.stub',
        )->withOutputPath(
            __DIR__.'/generator-result.txt',
        )->withPattern(
            '{{ %s }}',
        )->withPipes(
            Generator::PIPES,
        );

    return $generate ? $generator->generate() : $generator;
}

function passable(): Passable
{
    return (new Passable())
        ->withInput(['second' => '2nd', 'fourth' => '4th'])
        ->withInputPath(__DIR__.'/stubs/test.stub')
        ->withPattern('{{ %s }}');
}
