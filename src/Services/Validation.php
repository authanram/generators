<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Validation as Contract;
use Illuminate\Support\Facades\Validator;

final class Validation implements Contract
{
    /** @var array<string> */
    private array $exceptions = [];

    /**
     * @param array<string> $data
     * @param array<string> $rules
     */
    public static function validate(array $data, array $rules): void
    {
        $validator = Validator::make($data, $rules);

        $messages = $validator->errors()->messages();

        dd($messages);
    }
}
