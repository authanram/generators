<?php

declare(strict_types=1);

namespace Authanram\Generators\Exceptions;

use Exception;
use Throwable;

class ReadFromFilenamePipeFailureException extends Exception
{
    public const EMPTY = 100;
    public const EXISTS = 200;
    public const DIRECTORY = 300;
    public const READABLE = 400;

    /** @var array<string> */
    private array $messages = [
        100 => 'Filename [%s] must not be empty.',
        200 => 'Filename [%s] not found.',
        300 => 'Filename [%s] must not be a directory.',
        400 => 'Filename [%s] must be readable.',
    ];

    public function __construct(string $filename, $code = 100, Throwable $previous = null)
    {
        $message = sprintf($this->messages[$code], $filename);

        parent::__construct($message, $code, $previous);
    }
}
