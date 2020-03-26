function exec_root() {
    echo_with_color "\nExecuting on 'php-docker' like user 'root': '$*'\n"
    docker exec -w "/var/www/html" php-docker "$@"
}

function exec_server() {
    echo_with_color "\nExecuting on 'php-docker' like user 'www-data': '$*'\n"
    docker exec -w "/var/www/html/server" -u "www-data" php-docker "$@"
}

function docker_compose() {
    echo_with_color "\nExecuting docker-compose $* \n"
    DOCKER_DIR="$(get_docker_dir)"
    cd "${DOCKER_DIR}" &&
        docker-compose "$@"
}

function get_docker_dir() {
    echo -e "$(cd "$(dirname "${BASH_SOURCE[0]}")/../../docker" >/dev/null 2>&1 && pwd)"
    return 0
}

function get_root_dir() {
    echo -e "$(cd "$(dirname "${BASH_SOURCE[0]}")/../.." >/dev/null 2>&1 && pwd)"
    return 0
}

function logo() {

    #                 ▄▄██▄▄
    #             ▄▄██████████▄▄
    #          ▄██████████████████▄▄
    #        ████████▀█████▀█████████      ███▄    ███▌   ▄█████▄▄   ███████▄▄   ███  ███        █████████▌            ▐█      ▐█▌      ▀▀▀▀▀▀▀█   ▀▀▀▀▀▀██
    #        ███████▀  ▀██   ▀███████      █████ ▄████▌  ███▀ ▀▀██▌  ███  ▀███▌  ███  ███        ███▌                  ▐█      █ █▄           █▀        ▄█
    #        ████████▄   ██▄   ██████      ███████████▌ ▐██▌    ███  ███▄▄▄███   ███  ███        ███▌▄▄▄▄              ▐█     █▌  █         ▄█         █▀
    #        ████▀  ▀█▌   ▀█▄   ▀████      ███ ▀██ ▐██▌ ▐██▌    ███  ███▀▀▀███   ███  ███        ████▀▀▀▀              ▐█    ▄█   ▐█       █▀        ▄█
    #        ████   ████▄  ███▄  ████      ███     ▐██▌ ▐███   ▄███  ███   ▐███  ███  ███        ███▌           █▌     ▐█   ▐█▄▄▄▄▄█▌    ▄█         ▄▀
    #        █████▄██████▄█████▄█████      ███     ▐██▌   ███████▀   ████████▀   ███  █████████▌ █████████▌      ▀▄▄▄▄▄█    █       █   ██▄▄▄▄▄▄   ██▄▄▄▄▄▄
    #         ▀████████████████████▀
    #            ▀▀████████████▀▀
    #                ▀▀████▀▀

    LOGO=$(base64 -d <<<"H4sIAExlKF4AA82WORLDIAxFe5+Co1KooHDhKgfMSTJmWL4WZKVJYFQYs0h6fGQfSbb3i6qVavezmvKvdrAeD3Rl2yQAwQfC3jqdkco6zhx4M03tRqJ/Jptaw+HDAjfCo5dB85rmzAsivXBCTU5bWQyh/2eYuW1SYMMIwvpSMTvZnJwwJj4qXcmxNUiGzYJX0jxkXJ5njxijiOLwpG1NBE68J9APuGdjZd7rD6GDKCJYLO4zoALuMEy8i9wcVCCjE2REWlJiNaiPUYkhylxgXyDCxSxBRDRooMCexLSCpPyTrEkephmYBlRGGFbmfGJUQYzHeDE49E2J2zwtISNSlJ1LZ36+zOrsXUCNzCuC3sdmKT9tZ6jkV9VJdC34CQXcirnkD0nAy6oeNnl2v2/s50zcej/0HaJP8u8y2UnsEuzdjg9dwoXwvQsAAA==" | gunzip)

    echo_with_color "$LOGO"
}

function echo_with_color() {
    WHITE='\033[1;37m'
    NOCOLOR='\033[0m'
    echo -e "\n${WHITE}$1${NOCOLOR}\n"
}
