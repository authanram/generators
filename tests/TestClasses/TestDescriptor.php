<?php

declare(strict_types=1);

namespace Authanram\JetstreamPlugin\Generators;

use Authanram\Generators\Descriptor;

class TestDescriptor extends Descriptor
{
    public static function stub(): string
    {
        return 'property.stub';
    }

    public static function placeholders(): array
    {
        return [
            'namespace' => '',
            'uses' => '',
            'class' => '',
            'extends' => '',
            'implements' => '',
            'traits' => '',
            'comment' => '',
            'type' => '',
            'property' => '',
            'value' => '',
        ];
    }
}
