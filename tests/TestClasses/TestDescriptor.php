<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

use Authanram\Generators\Contracts\Descriptor;
use Authanram\Generators\Markers;

class TestDescriptor implements Descriptor
{
    public static function fill(Markers $markers): array
    {
        return [
            'second' => $markers->toCollection()->get('second'),
            'fourth' => $markers->toCollection()->get('fourth'),
        ];
    }
}
