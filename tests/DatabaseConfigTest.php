<?php

require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../config/database.php';

if (empty($config['host'])) {
    fwrite(STDERR, "Expected a database host to be configured\n");
    exit(1);
}

if (empty($config['dbname'])) {
    fwrite(STDERR, "Expected a database name to be configured\n");
    exit(1);
}

echo "Database config is valid\n";
