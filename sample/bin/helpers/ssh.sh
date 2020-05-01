#!/bin/bash
# Stop script on error
set -euo pipefail

HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/../helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

logo

echo_with_color "Opening terminal on php-docker as www-data user:"
docker exec -it -u "www-data" -w "/var/www/html" php-docker bash
