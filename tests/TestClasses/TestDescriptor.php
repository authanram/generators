<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

use Authanram\Generators\Descriptor;
use Authanram\Generators\Markers;

class TestDescriptor extends Descriptor
{
    public static function fromFilename(string $filename): static
    {
        return (new static())->setFilename($filename);
    }

    public static function fill(Markers $markers): array
    {
        return [
            'second' => $markers->get('second'),
            'fourth' => $markers->get('fourth'),
        ];
    }
}
