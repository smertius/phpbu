#!/usr/bin/env php
<?php
if (!isset($argv[1])) {
    exit(1);
}

if ($argv[1] == 'alpha' || $argv[1] == 'beta') {
    $version = sprintf('%s-%s', $argv[1], date('Y-m-d'));
} else {
    $version = $argv[1];
}

file_put_contents(
    __DIR__ . '/phar/phpbu/App/Version.php',
    str_replace(
        'private static $pharVersion;',
        'private static $pharVersion = "' . $version . '";',
        file_get_contents(__DIR__ . '/phar/phpbu/App/Version.php')
    )
);

echo $version;