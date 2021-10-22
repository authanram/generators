<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Generator;

it('validates template', function () {
    Generator::new()->template('');
});

it('validates pattern', function () {
    Generator::new()->pattern('');
});

it('validates pipes', function () {
    Generator::new()->pipes([]);
});
