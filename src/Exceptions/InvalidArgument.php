<?php

declare(strict_types=1);

namespace Authanram\Generators\Exceptions;

use Exception;
use Throwable;

class InvalidArgument extends Exception
{
    public const EMPTY = 100;

    /** @var array<string> */
    private array $messages = [
        100 => 'Argument {%s} must not be empty.',
    ];

    public function __construct(string $argument, int $code = 100, Throwable|null $previous = null)
    {
        $message = sprintf($this->messages[$code], $argument);

        parent::__construct($message, $code, $previous);
    }
}
