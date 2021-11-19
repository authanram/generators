<?php /** @noinspection PhpDocSignatureIsNotCompleteInspection */

declare(strict_types=1);

use Authanram\Generators\Generator;
use Authanram\Generators\Input;
use Authanram\Generators\Passable;
use Authanram\Generators\Pipes;

function __fillCallback(): Closure
{
    /** @return array<string> */
    return static fn (Input $input) => [
        'second' => $input->str('second')->lower(),
        'fourth' => $input->str('fourth')->upper(),
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
    return new Generator();
}

function passable(): Passable
{
    return new Passable();
}
