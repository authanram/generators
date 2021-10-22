<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Validation as Contract;
use Authanram\Generators\Exceptions\ValidationFailed;
use Illuminate\Support\Facades\Validator;

final class Validation implements Contract
{
    /** @var array<string> */
    private array $rules = [];

    /** @param array<callable|string> $rules */
    public function rules(array $rules): self
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * @param array<string> $data
     *
     * @throws ValidationFailed
     */
    public function validate(array $data): self
    {
        $validator = Validator::make($data, $this->rules);

        $errors = $validator->errors();

        if ($errors->isEmpty()) {
            return $this;
        }

        $key = $errors->keys()[0];

        throw new ValidationFailed(
            $key,
            $data[$key],
            gettype($data[$key]),
            $errors->first(),
        );
    }
}
