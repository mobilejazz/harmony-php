#!/bin/bash
HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

# See Sample Readme
exec_wwwdata ./vendor/bin/pest --no-interaction --coverage --min=98
