# Contributing

Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on [Github][link-project-home].

## Pull Requests

-   **[PSR-2 Coding Standard][link-psr2]** - The easiest way to apply the
    conventions is to install [PHP Code Sniffer][phpcs].

-   **[Yoda Notation][link-yoda-notation]** - To avoid a possible mistake
    assigning a value unintentionally instead of writing a conditional
    statement.

-   **Avoid plural names for arrays** - Because plural names and singular only
    have one or two different characters, are difficult to distinct, and that
    can originate mistakes. Instead, use same singular name with suffix like
    Set, List, Collection, Pool, etc.

-   **Add tests!** - Your patch won't be accepted if it doesn't have tests.

-   **Document any change in behaviour** - Make sure the `README.md` and any
    other relevant documentation are kept up-to-date.

-   **Consider our release cycle** - We try to follow
    [SemVer v2.0.0][link-semver]. Randomly breaking public APIs is not an
    option.

-   **Create feature branches** - Don't ask us to pull from your master branch.

-   **One pull request per feature** - If you want to do more than one thing,
    send multiple pull requests.

-   **Send coherent history** - Make sure each individual commit in your pull
    request is meaningful. If you had to make multiple intermediate commits
    while developing, please [squash them][link-git-scm-commits] before
    submitting.

## Running Tests

``` bash
composer test
```

# NOTES

PHP mod xDebug helps debugging code and execute PHPUnit test, but makes composer and other scripts slow. To deactivate. Run next command.

``` bash
sudo php5dismod -s cli xdebug
```

And turn on, calling command.

``` bash
sudo php5enmod -s cli xdebug
```

**Happy coding**!

[link-project-home]: https://github.com/martiadrogue/cache
[phpcs]: https://github.com/squizlabs/PHP_CodeSniffer
[link-psr2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[link-semver]: http://semver.org/
[link-git-scm-commits]: http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages
[link-yoda-notation]: https://en.wikipedia.org/wiki/Yoda_conditions
