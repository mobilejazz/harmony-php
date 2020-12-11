#!/bin/bash
HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

# See Sample Readme
exec_wwwdata ./vendor/bin/psalm --show-info=true --php-version=8.0
exec_wwwdata ./vendor/bin/phpstan analyse -l max app ../../core ../../eloquent
exec_wwwdata ./vendor/bin/phpcs -p -s --standard=PSR1,PSR2 --exclude="Generic.WhiteSpace.ScopeIndent" app ../../core ../../eloquent
# @todo Waiting for PHP 8.0 version | @link https://github.com/phpmd/phpmd/issues/853
# phpmd @todo cleancode, naming
#exec_wwwdata ./vendor/bin/phpmd /var/www/html/app,/var/core/src,/var/eloquent/src text codesize,design,unusedcode
# @todo Waiting for PHP 8.0 version | @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/issues/4702
#exec_wwwdata ./vendor/bin/php-cs-fixer fix --dry-run --diff app
#exec_wwwdata ./vendor/bin/php-cs-fixer fix --dry-run --diff ../../core
#exec_wwwdata ./vendor/bin/php-cs-fixer fix --dry-run --diff ../../eloquent
