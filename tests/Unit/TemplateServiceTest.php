<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Generator;
use Authanram\Generators\Tests\TestClasses\FillCallbackInvokable;

it('validates the template', function () {
    Generator::new()->template('');
    Generator::new()->template('first second');
    //
    Generator::new()->template('first {{ second }} third {{ fourth }}');

    expect(true)->toBeTrue();
});

it('validates the fill-callback', function () {
    Generator::new()->fill(fn () => null);
    Generator::new()->fill(new FillCallbackInvokable());
    //
    Generator::new()->fill(fn (array $input) => []);

    expect(true)->toBeTrue();
});
