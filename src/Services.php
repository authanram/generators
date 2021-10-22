<?php

declare(strict_types=1);

namespace Authanram\Generators;

final class Services implements Contracts\Services
{
    public function validation()//: Validation
    {
        return 'xx';
        //return $this->app->make(Validation::class);
    }
}
