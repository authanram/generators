<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Generator;

it('validates the pipes', function () {
    Generator::new()->pipes([]);
    Generator::new()->pipes([Generator::class, 'second']);
    Generator::new()->pipes(['first', new \stdClass()]);
    //
    Generator::new()->pipes(['first', new \stdClass()]);

    expect(true)->toBeTrue();
});
