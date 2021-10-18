#!/bin/bash
HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

exec_wwwdata ./vendor/bin/psalm --show-info=true
exec_wwwdata ./vendor/bin/phpstan analyse -c phpstan.neon
exec_wwwdata ./vendor/bin/phpmd /var/www/html/app,/var/www/html/core ansi phpmd.xml
find ./src -path ./vendor -prune -o -type f -name "*.php" -print0 | xargs -0 -n1 -P4 php -l -n | (! grep -v "No syntax errors detected")
