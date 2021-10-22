<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts;

final class Services implements Contracts\Services
{
    /** @noinspection PhpUnhandledExceptionInspection */
    public function fileReader(): Contracts\Services\FileReader
    {
        return app()->make(Contracts\Services\FileReader::class);
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function fileWriter(): Contracts\Services\FileWriter
    {
        return app()->make(Contracts\Services\FileWriter::class);
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function input(): Contracts\Services\Input
    {
        return app()->make(Contracts\Services\Input::class);
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function pattern(): Contracts\Services\Pattern
    {
        return app()->make(Contracts\Services\Pattern::class);
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function pipes(): Contracts\Services\Pipes
    {
        return app()->make(Contracts\Services\Pipes::class);
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function template(): Contracts\Services\Template
    {
        return app()->make(Contracts\Services\Template::class);
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function validation(): Contracts\Services\Validation
    {
        return app()->make(Contracts\Services\Validation::class);
    }
}
