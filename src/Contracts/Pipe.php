<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

interface Pipe
{
    /**
     * @param Passable $passable
     * @param callable $next
     * @return Passable
     * @noinspection PhpMissingParamTypeInspection
     */
    public static function handle(Passable $passable, $next): Passable;
}