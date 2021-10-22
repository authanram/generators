<?php

declare(strict_types=1);

namespace Authanram\Generators\Services;

use Authanram\Generators\Contracts\Services\Template as Contract;
use Illuminate\Support\Facades\Validator;

final class Template implements Contract
{
    public function validateTemplate(string $subject): Contract
    {
        $errors = Validator::make(
            ['subject' => $subject],
            ['subject' => 'required|string'],
        )->errors();

        dd($errors->messages());

        return $this;
    }

    public function withTemplate(string $subject): Contract
    {
        return $this;
    }

    public function validateFillCallback(callable $fillCallback): Contract
    {
        return $this;
    }

    public function withFillCallback(callable $fillCallback): Contract
    {
        return $this;
    }
}
