<?php

declare(strict_types=1);

use Authanram\Generators\Assert;
use Authanram\Generators\Descriptor;

it('throws if template is empty', function (): void {
    passable()->withPattern(Descriptor::PATTERN)->withTemplate('');
})->expectExceptionMessage(Assert::message(Assert::NOT_EMPTY, '$template'));

it('throws if template does not contain template variables', function (): void {
    passable()->withPattern(Descriptor::PATTERN)->withTemplate('first');
})->expectExceptionMessage(Assert::message(Assert::VARIABLE, '$template'));
