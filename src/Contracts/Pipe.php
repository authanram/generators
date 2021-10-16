<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Closure;

interface Pipe
{
    /**
     * @param Descriptor $descriptor
     * @param Closure $next
     * @return Descriptor
     * @noinspection PhpMissingParamTypeInspection
     */
    public function handle(Descriptor $descriptor, $next): Descriptor;
}
