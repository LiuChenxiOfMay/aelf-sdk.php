{
    "name": "sebastian/object-enumerator",
    "description": "Traverses array structures and object graphs to enumerate all referenced objects",
    "homepage": "https://github.com/sebastianbergmann/object-enumerator/",
    "license": "BSD-3-Clause",
    "authors": [
        {
            "name": "Sebastian Bergmann",
            "email": "sebastian@phpunit.de"
        }
    ],
    "require": {
        "php": "^7.0",
        "sebastian/object-reflector": "^1.1.1",
        "sebastian/recursion-context": "^3.0"
    },
    "require-dev": {
        "phpunit/phpunit": "^6.0"
    },
    "autoload": {
        "classmap": [
            "src/"
        ]
    },
    "autoload-dev": {
        "classmap": [
            "tests/_fixture