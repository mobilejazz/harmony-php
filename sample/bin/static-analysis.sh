#!/bin/bash
HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

# See Sample Readme
exec_wwwdata ./vendor/bin/psalm --show-info=true
exec_wwwdata ./vendor/bin/phpstan analyse -l max app ../../core ../../eloquent
# phpmd @todo cleancode, naming
# @todo Waiting for PHP 8.0 version
#exec_wwwdata ./vendor/bin/phpmd /var/www/html/app,/var/core/src,/var/eloquent/src text codesize,design,unusedcode
exec_wwwdata ./vendor/bin/phpcs --standard=PSR2 app ../../core ../../eloquent
# @todo Waiting for PHP 8.0 version
#exec_wwwdata ./vendor/bin/php-cs-fixer fix --dry-run --diff app
#exec_wwwdata ./vendor/bin/php-cs-fixer fix --dry-run --diff ../../core
#exec_wwwdata ./vendor/bin/php-cs-fixer fix --dry-run --diff ../../eloquent
