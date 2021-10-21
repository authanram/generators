<?php

declare(strict_types=1);

namespace Authanram\Generators\Exceptions;

use Exception;
use Throwable;

class InvalidArgumentException extends Exception
{
    public const MESSAGE_EMPTY = 100;

    /** @var array<string> */
    private array $messages = [
        100 => 'Argument {%s} must not be empty.',
    ];

    public function __construct(string $argument, $code = 0, Throwable $previous = null)
    {
        $message = sprintf($this->messages[$code], $argument);

        parent::__construct($message, $code, $previous);
    }
}
