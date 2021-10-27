# Language independent code generation

... __in next to no time__!!

This package can generate code in any language. You can think of it as search
and replace pattern, just a bit more advanced.

---

Here's an example of how it can be used.

```php
Authanram\Generators\Generator::make()
    ->template('first {{ second }} third {{ fourth }}')
    ->input(['second' => '2nd', 'fourth' => '4TH'])
    ->fillCallback(fn ($input) => [
        'second' => $input->str('second')->upper(),
        'fourth' => $input->str('fourth')->lower(),
    ])->get();
```

This will lead to the following output:

```
first 2ND third 4th
```

Under the hood a simple search and replace routine will take place.

---

Refer to the [advanced guide](docs/advanced-guide.md) for more advanced usage
examples.

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
