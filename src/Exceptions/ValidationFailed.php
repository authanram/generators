<?php

declare(strict_types=1);

namespace Authanram\Generators\Exceptions;

use Exception;
use Throwable;

final class ValidationFailed extends Exception
{
    public const EMPTY = 100;

    /** @var array<string> */
    private array $messages = [
        'required' => 'Argument {:argument} must not be empty.',
        'string' => 'Argument {:argument} expected to be [:code], got [:type].',
    ];

    public function __construct(
        string $argument,
        mixed $value = null,
        string $type = null,
        string $code = 'required',
        Throwable|null $previous = null,
    ) {
        $code = ltrim($code, 'validation.');

        $message = __($this->messages[$code], [
            'argument' => '$'.$argument,
            'code' => $code,
            'type' => $type,
            'value' => $value,
        ]);

        parent::__construct($message, 0, $previous);
    }
}
