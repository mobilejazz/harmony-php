#!/bin/bash
HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

# See Sample Readme
# @todo Increase the % of coverage at same time that we add new test
exec_wwwdata ./vendor/bin/pest --no-interaction --coverage --min=27
# @todo Change Pest to PHPUnit with coverage
#exec_wwwdata ./vendor/bin/phpunit --testdox --testsuite "unit"
