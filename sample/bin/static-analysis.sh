#!/bin/bash
HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

# See Sample Readme
exec_wwwdata ./vendor/bin/psalm --show-info=true --php-version=8.1
exec_wwwdata ./vendor/bin/phpstan analyse -l max app core
# @todo PHP Mess Detector is not 100% with PHP 8.0 yet
#exec_wwwdata ./vendor/bin/phpmd /var/www/html/app,/var/www/html/core text codesize,design,cleancode
# @todo "Could not open input file"
#exec_wwwdata find . -path ./vendor -prune -o -type f -name '*.php' -print0 | xargs -0 -n1 -P4 php -l -n | (! grep -v 'No syntax errors detected' )
