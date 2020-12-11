#!/bin/bash
HELPERS_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/helpers" >/dev/null 2>&1 && pwd)"
source "${HELPERS_DIR}"/functions.sh

logo

docker_compose down
docker_compose up -d
exec_root /usr/local/bin/docker-set-host-internal.sh
docker_compose logs -f -t
docker_compose down
