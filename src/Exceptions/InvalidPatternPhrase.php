<?php

declare(strict_types=1);

namespace Authanram\Generators\Exceptions;

use Exception;
use Throwable;

class InvalidPatternPhrase extends Exception
{
    public const INVALID = 100;

    /** @var array<string> */
    private array $messages = [
        100 => 'Invalid pattern phrase [%s]. Must contain "%%s", e.g. "{{ %%s }}.',
    ];

    public function __construct(string $pattern, int $code = 100, Throwable|null $previous = null)
    {
        $message = sprintf($this->messages[$code], $pattern);

        parent::__construct($message, $code, $previous);
    }
}
