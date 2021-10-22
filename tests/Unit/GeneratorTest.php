<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Generator;
use Authanram\Generators\Tests\TestClasses\TestDescriptorFirst;

it('generates', function () {
    $passable = Generator::make(TestDescriptorFirst::class)
        ->generate([
            'second' => '2nd',
            'fourth' => '4nd',
        ]);

//    dd($passable, $passable->output());

    expect(true)->toBeTrue();
});
