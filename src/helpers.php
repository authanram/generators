<?php

declare(strict_types=1);

if (\function_exists('pipe') === false) {
    function pipe(mixed $value, Closure $callback): mixed {
        return $callback($value);
    }
}

if (\function_exists('rayReturn') === false) {
    function rayReturn(mixed $value): mixed {
        ray($value);
        return $value;
    }
}

if (\function_exists('str') === false) {
    function str(string $string): \Illuminate\Support\Stringable {
        return \Illuminate\Support\Str::of($string);
    }
}
