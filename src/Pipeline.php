<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Illuminate\Container\Container;
use Illuminate\Contracts\Pipeline\Pipeline as Contract;
use Illuminate\Pipeline\Pipeline as IlluminatePipeline;

final class Pipeline extends IlluminatePipeline
{
    public static function create(): Contract
    {
        return new IlluminatePipeline(new Container());
    }
}
