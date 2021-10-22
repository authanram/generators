<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Illuminate\Contracts\Container\Container as BaseContainer;

interface Container extends BaseContainer
{
    public function services(): Services;
}
