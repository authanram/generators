<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

use Authanram\Generators\Input;

it('throws if input key not exists', function (): void {
    (new Input([]))->get('first');
})->expectExceptionMessage('Undefined array key [first].');

it('resolves if key exists', function (): void {
    $input = (new Input(['first' => 'second']));

    expect($input->has('first'))->toBeTrue();
    expect($input->has('second'))->toBeFalse();
});

it('resolves with default value', function (): void {
    expect((new Input([]))->get('first', []))->toEqual([]);
});

it('resolves', function (): void {
    expect((new Input(['first' => 'second']))->get('first'))->toEqual('second');
});
