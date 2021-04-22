# ![Mobile Jazz Badge](https://raw.githubusercontent.com/mobilejazz/metadata/master/images/icons/mj-40x40.png) Harmony PHP | Sample

## How to Install

1. `bin/build.sh`
1. `bin/start.sh`

## How to Run

1. `bin/start.sh`
1. Visit [localhost](http://localhost/) in your browser.
1. `Ctrl+C` or `bin/stop.sh` to exit

## How to use XDebug

1. Configure server with `localhost` name and `localhost` host.
1. See `/docker/docker-compose.yml` to know the volumes for each folder.

## Static Analysis

1. `bin/static-analysis.sh`

We are using this tools to add Static Analysis and Generics to our PHP code:

-   [Psalm](https://psalm.dev/docs/)
-   [PHPStan](https://phpstan.org/)
-   [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
-   [PHP Mess Detector](https://phpmd.org/)
    Note: We don't use the `naming` rule as is incompatible with Harmony

## Testing

1. `bin/phpunit.sh`

We are using this tools for Unit Test and Coverage:

-   [PHPUnit](https://phpunit.readthedocs.io/en/9.5/writing-tests-for-phpunit.html#)
-   [Pest](https://pestphp.com/docs/writing-tests) (only to run test)

## Other

Info about Generics [Example 1](https://www.daveliddament.co.uk/articles/php-generics-today-almost/) and [Example 2
](https://medium.com/vimeo-engineering-blog/uncovering-php-bugs-with-template-a4ca46eb9aeb).
