<?php

use app\controllers\{UserController, ProductController, AuthController};
/**
 *@var \Slim\App $app
 */
$app->get('/', [AuthController::class, 'login']);
$app->post('/login', [AuthController::class, 'store']);
$app->get('/register', [AuthController::class, 'register']);
$app->post('/register', [AuthController::class, 'create']);
$app->get('/logout', [AuthController::class, 'logout']);

$app->get('/home', [UserController::class, 'index']);
$app->get('/dashboard', [UserController::class, 'dashboard']);

$app->get('/create-product', [ProductController::class, 'createProduct']);
$app->post('/register-product', [ProductController::class, 'registerProduct']);
$app->get('/list-products', [ProductController::class, 'list_all_products']);
$app->get('/edit-product/{id}', [ProductController::class, 'editProduct']);
$app->post('/update-product', [ProductController::class, 'updateProduct']);
$app->get('/delete-product/{id}', [ProductController::class, 'deleteProduct']);
$app->get('/outflow', [ProductController::class, 'outflowForm']);
$app->post('/outflow', [ProductController::class, 'outflowProduct']);
