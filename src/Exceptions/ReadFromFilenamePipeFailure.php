<?php

declare(strict_types=1);

namespace Authanram\Generators\Exceptions;

use Exception;
use Throwable;

class ReadFromFilenamePipeFailure extends Exception
{
    public const EXISTS = 100;
    public const EMPTY = 200;
    public const DIRECTORY = 300;
    public const READABLE = 400;

    /** @var array<string> */
    private array $messages = [
        100 => 'Filename [%s] not found.',
        200 => 'Filename [%s] must not be empty.',
        300 => 'Filename [%s] must not be a directory.',
        400 => 'Filename [%s] must be readable.',
    ];

    public function __construct(string $filename, int $code = 100, Throwable|null $previous = null)
    {
        $message = sprintf($this->messages[$code], $filename);

        parent::__construct($message, $code, $previous);
    }
}
