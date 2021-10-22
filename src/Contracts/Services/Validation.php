<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts\Services;

interface Validation
{
    /** @var array<string> */
    public function rules(array $rules): self;

    /** @var array<mixed> */
    public function validate(array $data): self;
}
