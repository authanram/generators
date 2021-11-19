<?php /** @noinspection PhpDocSignatureIsNotCompleteInspection */

declare(strict_types=1);

namespace Authanram\Generators\Tests\TestClasses;

use Authanram\Generators\Descriptor;
use Authanram\Generators\Input;

final class TestDescriptorB extends Descriptor
{
    public static function path(): string
    {
        return __DIR__.'/../stubs/test.stub';
    }

    /** @return array<string> */
    public static function fill(Input $input): array
    {
        return [];
    }
}
