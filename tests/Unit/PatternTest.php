<?php

declare(strict_types=1);

use Authanram\Generators\Pattern;

it('throws if {$pattern} is empty', function () {
    Pattern::make('');
})->expectExceptionMessage(Pattern::$messagePatternEmpty);

it('throws if {$pattern} is invalid', function () {
    Pattern::make('first');
})->expectExceptionMessage(Pattern::$messagePatternInvalid);

it('resolves the pattern', function () {
    $pattern = Pattern::make('!! %s ##');
    expect($pattern->getPhrase())->toEqual('!! %s ##');
});
