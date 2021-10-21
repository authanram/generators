<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Exceptions\InvalidArgument;
use Authanram\Generators\Exceptions\InvalidPatternPhrase;
use Authanram\Generators\Pattern;

it('throws if argument {$phrase} is empty', function () {
    Pattern::make('');
})->expectExceptionMessage(
    (new InvalidArgument('$phrase'))->getMessage(),
);

it('throws if argument {$pattern} is invalid', function () {
    Pattern::make('first');
})->expectExceptionMessage(
    (new InvalidPatternPhrase('first'))->getMessage(),
);

it('resolves the pattern phrase', function () {
    $pattern = Pattern::make('!! %s ##');
    expect($pattern->phrase())->toEqual('!! %s ##');
});
