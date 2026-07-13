<?php

use app\controllers\{UserController, ProductController, AuthController};
/**
 *@var \Slim\App $app
 */
$app->get('/', [AuthController::class, 'login']);
$app->post('/login', [AuthController::class, 'store']);


$app->get('/home', [UserController::class, 'index']);
$app->get('/dashboard', [UserController::class, 'dashboard']);

$app->get('/create-product', [ProductController::class, 'createProduct']);
$app->post('/register-product', [ProductController::class, 'registerProduct']);

