<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

use Authanram\Generators\Descriptor;
use Authanram\Generators\Mutators\Php as PHP;
use Authanram\Generators\Mutators\Stringable;

class OtherTestDescriptor extends Descriptor
{
    public static function stub(): string
    {
        return 'property.stub';
    }

    public static function placeholders(): array
    {
        return [
            [Stringable::CAMEL, 'foo', 'bar'],
            (Stringable::CAMEL)::make('foo', 'bar'),
            (Stringable::CAMEL)(),
//            Mutators\Comment::class,
//            PHP::GETTER,
//            PHP::setter(),
//            Mutators\Type::class,
//            Mutators\TypeDoc::class,
//            Mutators\Uses::class,
//            Mutators\Value::class,
//            Mutators\Variable::class,
//            Mutators\VariableDoc::class,
        ];
    }
}
