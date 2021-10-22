<?php

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

class FillCallbackInvokable
{
    public function __invoke(array $input): array
    {
        return [];
    }
}
