<?php

declare(strict_types=1);

use Authanram\Generators\Passable;
use Authanram\Generators\Tests\TestClasses\TestDescriptor;

it('resolves the descriptor', function () {
    $passable = Passable::make(new TestDescriptor);

    expect($passable)->toBeInstanceOf(Passable::class);
    expect($passable->getDescriptor())->toBeInstanceOf(TestDescriptor::class);
});
