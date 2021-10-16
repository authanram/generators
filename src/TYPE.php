<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Closure;
use Iterator;
use Stringable;

class TYPE
{
    public const ARRAY_TYPE = 'ARRAY_TYPE';
    public const BOOL_TYPE = 'BOOL_TYPE';
    public const CALLABLE_TYPE = 'CALLABLE_TYPE';
    public const FLOAT_TYPE = 'FLOAT_TYPE';
    public const INT_TYPE = 'INT_TYPE';
    public const ITERABLE_TYPE = 'ITERABLE_TYPE';
    public const MIXED_TYPE = 'MIXED_TYPE';
    public const OBJECT_TYPE = 'OBJECT_TYPE';
    public const SELF_TYPE = 'SELF_TYPE';
    public const STATIC_TYPE = 'STATIC_TYPE';
    public const STRING_TYPE = 'STRING_TYPE';
    //
    public const BOOL_TYPE_TRUE = 'BOOL_TYPE_TRUE';
    public const BOOL_FALSE_FALSE = 'BOOL_FALSE_FALSE';

    public const TYPE = [
        self::ARRAY_TYPE => '[]',
        self::BOOL_TYPE => 'bool',
        self::CALLABLE_TYPE => Closure::class,
        self::FLOAT_TYPE => 'float',
        self::INT_TYPE => 'int',
        self::ITERABLE_TYPE => Iterator::class,
        self::MIXED_TYPE => 'mixed',
        self::OBJECT_TYPE => 'object',
        self::SELF_TYPE => 'self',
        self::STATIC_TYPE => 'static',
        self::STRING_TYPE => 'string',
        //
        self::BOOL_TYPE_TRUE => 'bool',
        self::BOOL_FALSE_FALSE => 'bool',
    ];

    public const VALUE = [
        self::ARRAY_TYPE => '[]',
        self::BOOL_TYPE => 'false',
        self::CALLABLE_TYPE,
        self::FLOAT_TYPE => '0',
        self::INT_TYPE => '0',
        self::ITERABLE_TYPE,
        self::MIXED_TYPE,
        self::OBJECT_TYPE,
        self::SELF_TYPE,
        self::STATIC_TYPE,
        self::STRING_TYPE => "''",
        //
        self::BOOL_TYPE_TRUE => 'true',
        self::BOOL_FALSE_FALSE => 'false',
    ];

    private function __construct(private string $result) {}

    public static function resolve(Stringable|string $result): static
    {
        return new static((string)$result);
    }

    public function typeHint(): string//Result
    {
        return self::TYPE[$this->result];
        //return Success::create($this->result);
    }

    public function docBlock(): string//Result
    {
        return self::TYPE[$this->result];
        //return Success::create($this->result);
    }

    public function defaultValue(): string
    {
        return self::VALUE[$this->result];
    }
}
