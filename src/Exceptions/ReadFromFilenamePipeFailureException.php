<?php

declare(strict_types=1);

namespace Authanram\Generators\Exceptions;

use Exception;
use Throwable;

class ReadFromFilenamePipeFailureException extends Exception
{
    public const MESSAGE_EXISTS = 100;
    public const MESSAGE_DIRECTORY = 200;
    public const MESSAGE_READABLE = 300;
    public const MESSAGE_EMPTY = 400;

    /** @var array<string> */
    private array $messages = [
        100 => 'Filename [%s] not found.',
        200 => 'Filename [%s] must not be a directory.',
        300 => 'Filename [%s] must be readable.',
        400 => 'Filename [%s] must not be empty.',
    ];

    public function __construct(string $filename, $code = 0, Throwable $previous = null)
    {
        $message = sprintf($this->messages[$code], $filename);

        parent::__construct($message, $code, $previous);
    }
}
