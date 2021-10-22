<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

use Authanram\Generators\Descriptor;
use Authanram\Generators\Data;
use Illuminate\Support\Str;

class TestDescriptorFirst extends Descriptor
{
    public static function template(): string
    {
        return 'first {{ second }} third {{ fourth }}';
    }

    public static function fill(Data $data): array
    {
        return [
            'second' => (string)Str::of($data->get('second'))->kebab(),
            'fourth' => (string)Str::of($data->get('fourth'))->upper(),
        ];
    }
}
