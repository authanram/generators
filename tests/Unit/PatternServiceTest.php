<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Generator;

it('validates the pattern', function () {
    Generator::new()->pattern('');
    Generator::new()->pattern('%s');
    Generator::new()->pattern('##');
    Generator::new()->pattern('{{%s}}');
    Generator::new()->pattern('{{ %s }');
    //
    Generator::new()->pattern('{{ %s }}');
    Generator::new()->pattern('!! %s ##');

    expect(true)->toBeTrue();
});
