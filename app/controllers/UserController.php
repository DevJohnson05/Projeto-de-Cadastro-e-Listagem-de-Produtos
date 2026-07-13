<?php 
namespace app\controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController extends BaseController
{
    public function index(Request $request, Response $response) {
        return $this->getView()->render($response, $this->setView('user/HomeView'),[
            'title' => 'HomePage',
            'name' => 'DevJohn'
        ]);
        
    }

    public function dashboard(Request $request, Response $response) {
        return $this->getView()->render($response, $this->setView('user/Dashboard'), [
            'title' => 'DashboardPage'
        ]);
    }
}