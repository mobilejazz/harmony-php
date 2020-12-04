# ![Mobile Jazz Badge](https://raw.githubusercontent.com/mobilejazz/metadata/master/images/icons/mj-40x40.png) Harmony PHP | Sample

## How to Install

1. git clone this repo
1. `cd sample`
1. `./bin/build.sh`
1. `./bin/start.sh`

## How to Run

1. `./bin/start.sh`
1. Visit [localhost](http://localhost/) in your browser.
1. `Ctrl+C` to exit or `./bin/stop.sh`

## How to use XDebug

1. Configure server with `localhost` name and `localhost` host.
1. See `/docker/docker-compose.yml` to know the volumes for
 each
 folder.

## Static Analysis

We are using this tools to add Static Analysis and Generics to our PHP code:

* [Psalm](https://psalm.dev/docs/)
* [PHPStan](https://phpstan.org/)
* @todo [Phan](https://github.com/phan/phan/wiki) (Note: needs `php-ast` to run)

Info about Generics [Example 1](https://www.daveliddament.co.uk/articles/php-generics-today-almost/) and [Example 2
](https://medium.com/vimeo-engineering-blog/uncovering-php-bugs-with-template-a4ca46eb9aeb).

Perform Static Analysis:

1. Run `./bin/static-analysis.sh`
