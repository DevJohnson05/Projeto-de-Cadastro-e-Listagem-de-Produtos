<?php

namespace app\controllers;

use app\service\AuthService;
use Psr\Http\Message\{ResponseInterface as Response, ServerRequestInterface as Request};

class AuthController extends BaseController
{
    private AuthService $authService;
    public function __construct() {
        $this->authService = new AuthService;
    }
    public function login(Request $request, Response $response) {
        return $this->getView()->render($response, $this->setView('auth/LoginView'));
    }

    public function store(Request $request, Response $response) {
        
       
        return $response->withHeader('Location', '/home')->withStatus(302);
    }
    protected function create() {
        
    }
}
