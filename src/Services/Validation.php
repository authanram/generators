<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Validation as Contract;

use Illuminate\Support\Facades\Validator as IlluminateValidator;

final class Validation implements Contract
{
    private array $exceptions = [
    ];

    public static function validate(array $data, array $rules): void
    {
        $validator = IlluminateValidator::make($data, $rules);

        $messages = $validator->errors()->messages();

        dd($messages);
    }
}
