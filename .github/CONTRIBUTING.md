# Contributing

1. [Create a fork](https://help.github.com/articles/fork-a-repo/)
2. Install dependencies `composer install`
3. Check (and keep in mind) the insights summary `composer run insights`
4. Create your feature branch `git checkout -b new-feature`
5. Commit your changes `git commit -am 'Add new feature'`
6. Test your changes `composer run test`
7. Check the insights summary again `composer run insights`
8. Push to the branch `git push origin new-feature`
9. [Create new Pull Request](https://help.github.com/articles/creating-a-pull-request/)

## Testing

We use [Pest](https://github.com/pestphp/pest) to write tests.

Run our test suite:

```
composer run test
```
or manually: `vendor/bin/pest`

### Watcher

To watch your tests while coding, run:

```
composer run test --watch
```

or manually: `vendor/bin/pest --watch`

## Code Style

We use [PHP Insights](https://github.com/nunomaduro/phpinsights) to maintain
code style, it's complexity and the architecture. Please make sure your PR
adheres to the guides by running:

```
composer run insights
```

To fix your code alongside, run: `composer run insights --fix`

```
composer run insights --fix
```

or simply run: `composer run fix`

---

__GL__ & __HF__!!^1 &nbsp;👍
