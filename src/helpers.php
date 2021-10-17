<?php

declare(strict_types=1);

if (\function_exists('pipe') === false) {
    function pipe(mixed $value, callable $callback): mixed {
        return $callback($value);
    }
}

if (\function_exists('rayReturn') === false) {
    function rayReturn(mixed $value): mixed {
        ray($value);
        return $value;
    }
}
