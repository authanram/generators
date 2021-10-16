<?php

declare(strict_types=1);

namespace Authanram\JetstreamPlugin\Generators;

use Authanram\Generators\Mutators;

class TestDescriptor
{
    public static function stub(): string
    {
        return 'property.stub';
    }

    public static function type(): string
    {
        return 'Property Trait';
    }

    public static function description(): string
    {
        return 'Create a new property trait';
    }

    public static function namespace(): string
    {
        return 'Authanram\JetstreamPlugin\Concerns\Properties';
    }

    public static function mutators(): array
    {
        return [
            Mutators\Comment::class,
            Mutators\Getter::class,
            Mutators\Setter::class,
            Mutators\Type::class,
            Mutators\TypeDoc::class,
            Mutators\Uses::class,
            Mutators\Value::class,
            Mutators\Variable::class,
            Mutators\VariableDoc::class,
        ];
    }
}
