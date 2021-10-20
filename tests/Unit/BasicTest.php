<?php

declare(strict_types=1);

use Authanram\Generators\Tests\TestClasses\TestDescriptor;
use Authanram\Generators\Generator;

it('generates', function () {
    $result = Generator::make(TestDescriptor::class, 'first {{ second }} third {{ fourth }}')
        ->generate(['second' => '2nd', 'fourth' => '4th']);

    expect($result)->toBe('first 2nd third 4th');
});
