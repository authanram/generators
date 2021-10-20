<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Authanram\Generators\Markers;

interface Descriptor
{
    /** @return string[] */
    public static function fill(Markers $markers): array;
}
