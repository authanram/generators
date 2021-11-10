# Generators

This package is about __language independent code generation__, in next to no
time.

## Installation

You can install the package via composer.

```shell
composer require authanram/generators
```

## Basic Usage Example

Here's an example of how it can be used in a very basic way:

```php
(new Authanram\Generators\Generator())
    ->withTemplate('first {{ second }} third {{ fourth }}')
    ->withInput(['second' => '2nd', 'fourth' => '4th'])
    ->get();
```

This will lead to the following result:

```shell
first 2nd third 4th
```

## Documentation

To learn all about this package, head over to the [documentation](https://authanram.com/f27aec6e-4516-4e70-bf00-c15ab72b2e71).

_(Note: The documentation is currently under construction.)_

## Changelog

Please see [CHANGELOG](https://github.com/authanram/generators/blob/master/CHANGELOG.md) for
more information on what has changed recently.

## Contributing

Please see the [contribution guide](https://github.com/authanram/generators/blob/master/.github/CONTRIBUTING.md)
for details.

## Security Vulnerabilities

Please review [our security policy](https://github.com/authanram/generators/security/policy)
on how to report security vulnerabilities.

## Credits

- [Daniel Seuffer](https://github.com/authanram)
- [and Contributors](https://github.com/authanram/generators/graphs/contributors) &nbsp;❤️

## License

The MIT License (MIT). Please see [License File](https://github.com/authanram/generators/blob/master/LICENSE.md)
for more information.
