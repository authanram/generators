# Introduction

- [Package Description](#package-description)
- [Basic usage example](#basic-usage-example)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Security Vulnerabilities](#security-vulnerabilities)
- [Credits](#credits)
- [License](#license)

## Package Description

This package is about __language independent code generation__, in next to no
time.

## Basic usage example

Here's an example of how it can be used in a very basic way:

```php
(new Authanram\Generators\Generator())
    ->withTemplate('first {{ second }} third {{ fourth }}')
    ->withInput(['second' => '2nd', 'fourth' => '4TH'])
    ->withFillCallback(fn ($input) => [
        'second' => $input->str('second')->upper(),
        'fourth' => $input->str('fourth')->lower(),
    ])->get();
```

This will lead to the following output:

```shell
first 2ND third 4th
```

## Documentation

You will find full documentation on the dedicated
[documentation](https://authanram.com/docs/generators) site.

## Changelog

Please see [CHANGELOG](https://github.com/authanram/generators/blob/master/CHANGELOG.md) for
more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/authanram/generators/blob/master/.github/CONTRIBUTING.md)
for details.

## Security Vulnerabilities

Please review [our security policy](https://github.com/authanram/generators/security/policy)
on how to report security vulnerabilities.

## Credits

- [Daniel Seuffer](https://github.com/authanram)
- [and Contributors](https://github.com/authanram/generators/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/authanram/generators/blob/master/LICENSE.md)
for more information.
