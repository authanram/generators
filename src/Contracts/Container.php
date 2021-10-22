<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

//use Authanram\Generators\Contracts\Services\Validation;

interface Container extends \Illuminate\Contracts\Container\Container
{
    //public function validation();//: Validation;
    public function services(): Services;
}
