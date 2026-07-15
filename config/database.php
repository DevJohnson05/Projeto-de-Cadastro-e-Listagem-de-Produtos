<?php

if (!class_exists(Dotenv\Dotenv::class)) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

use Dotenv\Dotenv;

$env = Dotenv::createImmutable(__DIR__ . '/..');
$env->safeLoad();

$resolveEnv = static function (array $names, mixed $default = null): mixed {
    foreach ($names as $name) {
        $value = $_ENV[$name] ?? getenv($name);
        if ($value !== null && $value !== false && $value !== '') {
            return $value;
        }
    }

    return $default;
};

$host = $resolveEnv(['DB_HOST', 'MYSQL_HOST'], '127.0.0.1');
if ($host === 'localhost') {
    $host = '127.0.0.1';
}
$user = $resolveEnv(['DB_USER', 'MYSQL_USER'], 'root');
$password = $resolveEnv(['DB_PASSWORD', 'MYSQL_PASSWORD'], '');
$dbname = $resolveEnv(['DB_NAME', 'MYSQL_DATABASE'], 'sistemaDeCadastroElistagem');
$port = $resolveEnv(['DB_PORT'], '3306');

return [
    'host' => $host,
    'user' => $user,
    'password' => $password,
    'dbname' => $dbname,
    'port' => $port,
];
