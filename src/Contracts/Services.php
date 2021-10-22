<?php

declare(strict_types=1);

namespace Authanram\Generators\Contracts;

use Authanram\Generators\Contracts\Services as Contracts;

interface Services
{
    public function fileReader(): Contracts\FileReader;
    public function fileWriter(): Contracts\FileWriter;
    public function input(): Contracts\Input;
    public function pattern(): Contracts\Pattern;
    public function pipes(): Contracts\Pipes;
    public function template(): Contracts\Template;
    public function validation(): Contracts\Validation;
}
