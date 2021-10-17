<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators;

use Authanram\Generators\Mutators\Stringable\Camel;

/** @todo generate from directory contents */
class Stringable
{
    /** @var Camel|string */
    public const CAMEL = Camel::class;

    use Stringable\Plain;
    use Stringable\Prepend;
    use Stringable\Studly;
    use Stringable\Wrap;
}
