<?php

declare(strict_types=1);

namespace Authanram\Generators\Exceptions;

use Exception;
use Throwable;

class MustImplementInterfaceException extends Exception
{
    public function __construct(string $subject, string $interface, int $code = 0, Throwable|null $previous = null)
    {
        $message = sprintf('[%s] must implement interface [%s].', $subject, $interface);

        parent::__construct($message, $code, $previous);
    }
}