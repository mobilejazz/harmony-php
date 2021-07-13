#!/bin/bash
# Stop script on error
set -euo pipefail

HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/../helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

logo

echo_with_color "Opening terminal on php-sample-docker as root user:"
docker exec -it -u "root" -w "/var/www/html" php-sample-docker sh
