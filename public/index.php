<?php
require_once(__DIR__.'/../vendor/autoload.php');
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

$app = AppFactory::create();
require_once(__DIR__.'/../app/routes/web.php');

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function(Request $request, Response $response) {
    $twig = Twig::create(DIR_VIEWS);
    $twig->render($response, 'http/404.html', ['message' => 'Route Not Found'])->withStatus(404);
    return $response;
});

$app->run();