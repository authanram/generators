<?php

declare(strict_types=1);

namespace Authanram\Generators\Mutators;

/** @todo generate from directory contents */
class Php
{
    public const CLASSNAME = Php\Classname::class;
    public const GETTER = Php\Getter::class;

    use Php\Classname;
    use Php\Getter;
    use Php\NamespaceName;
    use Php\Setter;
    use Php\Type;
    use Php\Uses;
    use Php\Value;
    use Php\Variable;
}
