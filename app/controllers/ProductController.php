<?php

namespace app\controllers;

use Psr\Http\Message\{ResponseInterface as Response, ServerRequestInterface as Request};
use app\models\outflows\OutflowModel;
use app\models\products\ProductModel;
use app\service\ProductService;

class ProductController extends BaseController
{
    private ProductModel $productModel;
    private ProductService $productService;

    public function __construct()
    {
        parent::__construct();
        $this->productModel = new ProductModel();
        $this->productService = new ProductService();
    }

    public function createProduct(Request $request, Response $response)
    {
        $redirect = $this->ensureAuthenticated($response);
        if ($redirect) {
            return $redirect;
        }

        return $this->getView()->render($response, $this->setView('product/CreateProductView'), [
            'title' => 'Cadastro de Produto'
        ]);
    }

    public function registerProduct(Request $request, Response $response)
    {
        $redirect = $this->ensureAuthenticated($response);
        if ($redirect) {
            return $redirect;
        }

        $product = $this->productModel->create_product($request->getParsedBody() ?? []);
        if (!$product) {
            return $this->redirect($response, '/create-product');
        }

        return $this->redirect($response, '/list-products');
    }

    public function list_all_products(Request $request, Response $response)
    {
        $redirect = $this->ensureAuthenticated($response);
        if ($redirect) {
            return $redirect;
        }

        $products = $this->productModel->list_all();

        return $this->getView()->render($response, $this->setView('product/ListProductView'), [
            'title' => 'Listar Produtos',
            'products' => $products,
        ]);
    }

    public function editProduct(Request $request, Response $response, array $args)
    {
        $redirect = $this->ensureAuthenticated($response);
        if ($redirect) {
            return $redirect;
        }

        $product = $this->productModel->findById((int)($args['id'] ?? 0));
        if (!$product) {
            return $this->redirect($response, '/list-products');
        }

        return $this->getView()->render($response, $this->setView('product/EditProductView'), [
            'title' => 'Editar Produto',
            'product' => $product,
        ]);
    }

    public function updateProduct(Request $request, Response $response)
    {
        $redirect = $this->ensureAuthenticated($response);
        if ($redirect) {
            return $redirect;
        }

        $data = $request->getParsedBody() ?? [];
        $id = (int)($data['id'] ?? 0);
        if ($id <= 0) {
            return $this->redirect($response, '/list-products');
        }

        $this->productModel->update_product($id, $data);

        return $this->redirect($response, '/list-products');
    }

    public function deleteProduct(Request $request, Response $response, array $args)
    {
        $redirect = $this->ensureAuthenticated($response);
        if ($redirect) {
            return $redirect;
        }

        $id = (int)($args['id'] ?? 0);
        if ($id > 0) {
            $this->productModel->delete_product($id);
        }

        return $this->redirect($response, '/list-products');
    }

    public function outflowForm(Request $request, Response $response)
    {
        $redirect = $this->ensureAuthenticated($response);
        if ($redirect) {
            return $redirect;
        }

        $products = $this->productModel->list_all();

        return $this->getView()->render($response, $this->setView('product/OutflowProductView'), [
            'title' => 'Saída de Produto',
            'products' => $products,
        ]);
    }

    public function outflowProduct(Request $request, Response $response)
    {
        $redirect = $this->ensureAuthenticated($response);
        if ($redirect) {
            return $redirect;
        }

        $data = $request->getParsedBody() ?? [];
        $validated = $this->productService->validateOutflow($data);
        if (!$validated) {
            return $this->redirect($response, '/outflow');
        }

        $updated = $this->productModel->outflow_product($validated['product_id'], $validated['quantidade']);
        if (!$updated) {
            return $this->redirect($response, '/outflow');
        }

        $outflowModel = new OutflowModel();
        $outflowModel->create([
            'product_id' => $validated['product_id'],
            'quantidade' => $validated['quantidade'],
            'observacao' => $validated['observacao'],
        ]);

        return $this->redirect($response, '/dashboard');
    }

    private function redirect(Response $response, string $uri): Response
    {
        return $response->withHeader('Location', $uri)->withStatus(302);
    }
}

