#!/bin/bash
HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

# See Sample Readme
exec_wwwdata ./vendor/bin/psalm --show-info=true --php-version=8.0
exec_wwwdata ./vendor/bin/phpstan analyse -l max app core eloquent
exec_wwwdata ./vendor/bin/phpcs -p -s --standard=PSR1,PSR2 --exclude="Generic.WhiteSpace.ScopeIndent" app core eloquent
exec_wwwdata ./vendor/bin/phpmd /var/www/html/app,/var/www/html/core,/var/www/html/eloquent text codesize,design,cleancode
