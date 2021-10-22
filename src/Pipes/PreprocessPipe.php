<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;

final class PreprocessPipe implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
//        $validation = app()->services()->validation();
//
//        if ($this->type('foo')->isRaw()) {
//            $validation->rules(['subject' => 'required|string']);
//        } else {
//            $validation->rules(['subject' => 'required']);
//        }
//
//        $validation->validate(['subject' => 123]);

        return $next($passable);
    }
}
