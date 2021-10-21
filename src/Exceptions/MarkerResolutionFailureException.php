<?php

declare(strict_types=1);

namespace Authanram\Generators\Exceptions;

use Exception;
use Throwable;

class MarkerResolutionFailureException extends Exception
{
    public const MESSAGE_EXISTS = 100;

    /** @var array<string> */
    private array $messages = [
        100 => 'Marker [%s] not found.',
    ];

    public function __construct(string $marker, $code = 0, Throwable $previous = null)
    {
        $message = sprintf($this->messages[$code], $marker);

        parent::__construct($message, $code, $previous);
    }
}
