<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Authanram\Generators\Descriptor;

interface Pipe
{
    /**
     * @param Descriptor $descriptor
     * @param callable $next
     * @return Descriptor
     * @noinspection PhpMissingParamTypeInspection
     */
    public function handle(Descriptor $descriptor, $next): Descriptor;
}
