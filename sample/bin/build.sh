#!/bin/bash
# Stop script on error
set -euo pipefail

HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

logo

# Mac OS
if [[ "$OSTYPE" == "darwin"* ]]; then
    DOCKER_PHP_GROUP_ID=1000
    DOCKER_PHP_USER_ID=1000
else
    # Host User and Group Id to avoid permissions problems
    DOCKER_PHP_GROUP_ID=$(id -g)
    DOCKER_PHP_USER_ID=$(id -u)
fi

# Re-Build Dockerfile
docker_compose down
docker_compose rm -f
docker_compose build \
    --compress \
    --force-rm \
    --memory 1GB \
    --build-arg HOST_USER_ID="${DOCKER_PHP_USER_ID}" \
    --build-arg HOST_GROUP_ID="${DOCKER_PHP_GROUP_ID}"

docker_compose up -d php-sample
docker_compose exec php-sample composer install
docker_compose down
