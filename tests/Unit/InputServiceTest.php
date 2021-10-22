<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Generator;

it('validates the input', function () {
    Generator::new()->generate([]);

    expect(true)->toBeTrue();
});
