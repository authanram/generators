<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

interface Validation
{
    /** @param array<string> $rules */
    public function rules(array $rules): self;

    /** @param array<string> $data */
    public function validate(array $data): self;
}
