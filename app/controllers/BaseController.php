<?php

namespace app\controllers;

use app\service\SessionService;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class BaseController
{
    protected SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService;
    }

    protected function setView(string $name): string
    {
        return $name . ETX_VIEWS;
    }

    protected function getView()
    {
        try {
            return Twig::create(DIR_VIEWS);
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    protected function ensureAuthenticated(Response $response): ?Response
    {
        if (!$this->sessionService->is_authenticated()) {
            return $response->withHeader('Location', '/')->withStatus(302);
        }

        return null;
    }
}
