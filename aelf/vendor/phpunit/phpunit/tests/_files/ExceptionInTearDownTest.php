{
    "name": "yurunsoft/yurun-http",
    "description": "YurunHttp 是开源的 PHP HTTP 类库，支持链式操作，简单易用。支持 Curl、Swoole，支持 Http、Http2、WebSocket！",
    "require": {
        "php": ">=7.1.0",
        "psr/http-message": "~1.0",
        "yurunsoft/swoole-co-pool": "^1.1.0"
    },
    "require-dev": {
        "swoft/swoole-ide-helper": "~2.0",
        "phpunit/phpunit": ">=4 <8"
    },
    "type": "library",
    "license": "MIT",
    "autoload": {
        "psr-4": {
            "Yurun\\Util\\": "./src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Yurun\\Util\\YurunHttp\\Test\\": "tests/unit/"
        }
    },
    "scripts": {
        "test": "@php ./tests/phpunit -c ./tests/phpunit.xml",
   