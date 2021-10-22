<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

use Authanram\Generators\Descriptor;
use Illuminate\Support\Collection;

class TestDescriptorFirst extends Descriptor
{
    public static function template(): string
    {
        return 'first {{ second }} third {{ fourth }}';
    }

    public static function fill(Collection $data): array
    {
        return [
            'second' => '2nd',
            'fourth' => '4th',
        ];
    }
}
