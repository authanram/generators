<?php

declare(strict_types=1);

namespace Authanram\Generators;

/** @todo generate from directory contents */
class Mutators
{
    public const COMMENT = Mutators\Comment::class;
    public const GETTER = Mutators\Getter::class;
    public const NONE = Mutators\None::class;
    public const SETTER = Mutators\Setter::class;
    public const TYPE = Mutators\Type::class;
    public const TYPE_DOC = Mutators\TypeDoc::class;
    public const USES = Mutators\Uses::class;
    public const VALUE = Mutators\Value::class;
    public const VARIABLE = Mutators\Variable::class;
    public const VARIABLE_DOC = Mutators\VariableDoc::class;
}
