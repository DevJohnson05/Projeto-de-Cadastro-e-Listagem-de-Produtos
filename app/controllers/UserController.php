<?php

namespace app\controllers;

use app\models\products\ProductModel;
use app\service\ProductService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController extends BaseController
{
    public function index(Request $request, Response $response)
    {
        $redirect = $this->ensureAuthenticated($response);
        if ($redirect) {
            return $redirect;
        }

        $name = $this->sessionService->getSessionData('username');
        return $this->getView()->render($response, $this->setView('user/HomeView'), [
            'title' => 'HomePage',
            'name' => $name,
        ]);
    }

    public function dashboard(Request $request, Response $response)
    {
        $redirect = $this->ensureAuthenticated($response);
        if ($redirect) {
            return $redirect;
        }

        $productModel = new ProductModel();
        $productService = new ProductService();
        $products = $productModel->list_all();
        $outflows = $this->sessionService->getSessionData('outflows') ?? [];

        return $this->getView()->render($response, $this->setView('user/Dashboard'), [
            'title' => 'DashboardPage',
            'name' => $this->sessionService->getSessionData('username'),
            'dashboard' => $productService->buildDashboardData($products, $outflows),
        ]);
    }
}