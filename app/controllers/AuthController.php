<?php

namespace app\controllers;

use app\models\user\UserModel;
use app\service\AuthService;
use Psr\Http\Message\{ResponseInterface as Response, ServerRequestInterface as Request};

class AuthController extends BaseController
{
    private AuthService $authService;
    private UserModel $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService;
        $this->userModel = new UserModel;
    }

    public function login(Request $request, Response $response)
    {
        return $this->getView()->render($response, $this->setView('auth/LoginView'));
    }

    public function store(Request $request, Response $response)
    {
        if (!$this->authService->validation_login($request->getParsedBody())) {
            return $response->withHeader('Location', '/')->withStatus(302);
        }

        $user = $this->userModel->register_login($request->getParsedBody());
        if (!$user) {
            return $response->withHeader('Location', '/')->withStatus(302);
        }

        \app\service\SessionService::login($user);
        return $response->withHeader('Location', '/home')->withStatus(302);
    }

    public function register(Request $request, Response $response)
    {
        return $this->getView()->render($response, $this->setView('auth/RegisterView'));
    }

    public function create(Request $request, Response $response)
    {
        $userData = $this->authService->createRegisterUser($request->getParsedBody());

        if (!$userData) {
            return $response->withHeader('Location', '/register')->withStatus(302);
        }

        $this->userModel->create_user($userData);
        return $response->withHeader('Location', '/')->withStatus(302);
    }

    public function logout(Request $request, Response $response)
    {
        \app\service\SessionService::logout();
        return $response->withHeader('Location', '/')->withStatus(302);
    }
}
