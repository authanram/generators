# Getting started

To get started easily, perform the following workflow;

1. [Stub creation](#stub-creation) 
2. [Descriptor creation](#descriptor-creation) 
3. [Generator call](#generator-call)

## Stub creation

Create a file called `project/stubs/first.stub` with the following contents:

```php
<?php

echo 'first {{ second }} third {{ fourth }}';
```

## Descriptor creation

Create a file called `project/Generators/FirstDescriptor.php` with the following
contents:

```php
namespace Project\Generators;

use Authanram\Generators\Descriptor;
use Authanram\Generators\Input;

class FirstDescriptor extends Descriptor
{
    public static function stub(): string
    {
        return __DIR__.'/../stubs/first.stub';
    }

    public static function fill(Input $input): array
    {
        return [
            'second' => strtoupper($input->get('second')),
            'fourth' => strtolower($input->get('fourth')),
        ];
    }
}
```

Calling `$input->str('second')` will return a
[Fluent String](https://laravel.com/docs/master/helpers#fluent-strings), what
will ease the string manipulation.

```php
return [
    'second' => $input->str('second')->upper(),
    'fourth' => $input->get('fourth')->lower(),
];
```

## Generator call

Call the generator somewhere in your code:

```php
use Authanram\Generators\Exceptions\GeneratorException;
use Authanram\Generators\Generator;
use Project\Generators\FirstDescriptor;

/** @throws GeneratorException */
public static firstGeneratorCall(): void
{
    Generator::make(FirstDescriptor::class)
        ->withInput(['second' => '2nd', 'fourth' => '4TH'])
        ->withOutputPath(__DIR__.'/../generated/generated-code.php')
        ->generate();
}
```

In a real world scenario, it could look something like this:

```php
/** @throws GeneratorException */
public static firstGeneratorCall(array $data, string $outputPath): void
{
    Generator::make(FirstDescriptor::class)
        ->withInput($data)
        ->withOutputPath($outputPath)
        ->generate();
}
```

__Done!__ &nbsp;🎉&nbsp;&nbsp;🥳

---

### Expected Output

Path: `project/generated/generated-code.php`

```php
<?php

echo 'first 2ND third 4th';
```

---

Refer to the [advanced guide](advanced-guide.md).
