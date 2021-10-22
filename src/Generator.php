<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Services as Contracts;
use Illuminate\Pipeline\Pipeline;

final class Generator
{
    private Passable $passable;

    public function __construct()
    {
        $app = require __DIR__.'/app.php';

        $app->make(Contracts\Input::class);
        $app->make(Contracts\Pattern::class);
        $app->make(Contracts\Pipes::class);
        $app->make(Contracts\Template::class);
    }

    public static function make(Descriptor|string $descriptor): self
    {
        $instance = new self();

        $instance->passable = Passable::make($descriptor);

        return $instance;
    }

    /** @param array<callable> $input */
    public function generate(
        array $input,
        string|null $toFilename = null,
    ): Passable {
        Assert::isNonEmptyMap($input, '$input must be empty');
        Assert::isEmpty($toFilename, '$toFilename must not be empty.');

        $passable = $this->passable
            ->withInput($input)
            ->withToFilename($toFilename);

        return (new Pipeline(app()))
            ->send($passable)
            ->through($passable->descriptor()::pipes())
            ->thenReturn();
    }
}
