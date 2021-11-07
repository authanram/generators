# Language independent code generation

This package can generate code in any language, __in next to no time__!!^1

## Basic usage example

Here's an example of how it can be used in a very basic way:

```php
Authanram\Generators\Generator::make()
    ->withTemplate('first {{ second }} third {{ fourth }}')
    ->withInput(['second' => '2nd', 'fourth' => '4TH'])
    ->withFillCallback(fn ($input) => [
        'second' => $input->str('second')->upper(),
        'fourth' => $input->str('fourth')->lower(),
    ])->get();
```

This will lead to the following output:

```
first 2ND third 4th
```

Under the hood all data given to the generator like the template, input and so
on, will be passed through a pipeline, what can be extended easily, according
to your needs.

## Installation

You can install the package via composer:

```shell
composer require authanram/generators
```

I kept the code pretty flat and focused on extensibility over features. I think
i did a kind job. Feel free to start a discussion, tell me your critics and for
sure i would love if you start to contribute.

### Requirements

This package requires PHP 8.0 or higher.

## Usage

Further usage instructions can be found at the [documentation](docs/usage.md).

## Testing & Insights

Run the tests with:

```shell
composer test
```

## Insights

To audit the code quality, complexity, architecture and style, run: 

```shell
composer insights
```

## Changelog

Please see CHANGELOG for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report
security vulnerabilities.

## Credits

- [Daniel Seuffer](https://github.com/authanram)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
