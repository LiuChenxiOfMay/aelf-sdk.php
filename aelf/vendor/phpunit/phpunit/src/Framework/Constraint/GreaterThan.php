before_commands:
    - "composer install --no-dev --prefer-source"

checks:
    php:
        excluded_dependencies:
            - phpstan/phpstan

tools:
    external_code_coverage:
        enabled: true
        timeout: 300
        filter:
            excluded_paths: ["examples", "tests", "vendor"]
    php_code_sniffer:
        enabled: true
        config:
            standard: PSR2
        filter:
            paths: ["src/*", "tests/*"]
            excluded_paths: []
    php_cpd:
        enabled: true
        excluded_dirs: ["examples", "tests", "vendor"]
    php_cs_fixer:
        enabled: true
        config:
            level: all
        filter:
            paths: ["src/*", "tests/*"]
    php_loc:
        enabled: true
        excluded_dirs: ["examples", "tests", "vendor"]
    php_mess_detector:
        enabled: true
        config:
            ruleset: phpmd.xml.dist
            design_rules: { eval_expression: false }
        filter:
            paths: ["src/*"]
    php_pdepend:
        enabled: true
        excluded_dirs: ["examples", "tests", "vendor"]
    php_analyzer:
        enabled: true
        filter:
