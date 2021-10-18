<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

use Authanram\Generators\Descriptor;
use Authanram\Generators\Marker;

class OtherTestDescriptor extends Descriptor
{
    public static function template(): string
    {
        return 'property.stub';
    }

    public static function fill(Marker $data): array
    {
        return [
//            'namespace' => Php\NamespaceName::class,
//            'uses' => Php\Uses::class,
//            'class' => Php\Classname::class,
//            'extends' => 'extends',
//            'implements' => 'implements',
//            'traits' => Php\Uses::class,
//            'comment' => 'comment',
//            'type' => Php\Type::class,
//            'property' => Php\Variable::class,
//            'value' => Php\Value::class,
//            'getter' => Php\Getter::class,
//            'setter' => Php\Setter::class,
        ];
    }
}
