<?php

require __DIR__ . '/../vendor/autoload.php';

use app\service\AuthService;

$service = new AuthService();
$result = $service->createRegisterUser([
    'name' => 'Maria',
    'email' => 'maria@example.com',
    'password' => '123456',
]);

if (!is_array($result)) {
    fwrite(STDERR, "Expected createRegisterUser() to return an array for valid input\n");
    exit(1);
}

echo "Auth service returned a sanitized payload\n";
