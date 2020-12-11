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

Perform Static Analysis:

1. Run `./bin/static-analysis.sh`

We are using this tools to add Static Analysis and Generics to our PHP code:

-   [PHPStan](https://phpstan.org/)
-   [Psalm](https://psalm.dev/docs/)
-   @todo Update version of PHP Mess Detector to PHP 8.0
-   @todo Update version of PHP-CS-Fixer to PHP 8.0 `"friendsofphp/php-cs-fixer": "^2.16"`

Info about Generics [Example 1](https://www.daveliddament.co.uk/articles/php-generics-today-almost/) and [Example 2
](https://medium.com/vimeo-engineering-blog/uncovering-php-bugs-with-template-a4ca46eb9aeb).
