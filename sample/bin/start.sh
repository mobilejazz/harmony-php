#!/bin/bash
HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

logo

docker_compose down --remove-orphans
docker_compose rm -f
docker_compose up -d
docker_compose exec --user www-data php-sample composer install
docker_compose logs -f -t
docker_compose down --remove-orphans
docker_compose rm -f
