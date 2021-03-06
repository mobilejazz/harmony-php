#!/bin/bash
# Stop script on error
set -euo pipefail

HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

logo

# Host User and Group Id to avoid permissions problems
DOCKER_PHP_USER_ID=$(id -u)
#DOCKER_PHP_GROUP_ID=1000
# We can't use the Group ID on Mac OS
DOCKER_PHP_GROUP_ID=$(id -g)

# Re-Build Dockerfile
docker_compose down
docker_compose build \
    --compress \
    --force-rm \
    --memory 1GB \
    --build-arg HOST_USER_ID="${DOCKER_PHP_USER_ID}" \
    --build-arg HOST_GROUP_ID="${DOCKER_PHP_GROUP_ID}"

docker_compose up -d php
docker_compose exec php composer install
docker_compose down
