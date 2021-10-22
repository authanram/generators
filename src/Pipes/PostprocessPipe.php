<?php

declare(strict_types=1);

namespace Authanram\Generators\Pipes;

use Authanram\Generators\Contracts\Passable;
use Authanram\Generators\Contracts\Pipe;
//use Illuminate\Support\Str;

final class PostprocessPipe implements Pipe
{
    public static function handle(Passable $passable, callable $next): Passable
    {
//        $descriptor = $passable->descriptor();
//
//        $text = (string) Str::of($descriptor->text())
//            ->replace("\n\n\n", "\n");
//
//        return $next($passable->withDescriptor(
//            $descriptor->withText($text),
//        ));

        return $next($passable);
    }
}
