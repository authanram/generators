<?php

declare(strict_types=1);

$app = require __DIR__.'/../src/app.php';

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

function something()
{
    // ..
}
