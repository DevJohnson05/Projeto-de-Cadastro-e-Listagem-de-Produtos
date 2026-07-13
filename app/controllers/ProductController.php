<?php 
namespace app\controllers;

use Psr\Http\Message\{ResponseInterface as Response, ServerRequestInterface as Request};
use app\models\products\ProductModel;

class ProductController extends BaseController
{
    public function list() {

        $productModel = new ProductModel();
        $products = $productModel->All('produtos');

        $this->render('products', 'list', ['title' => 'Listagem de Produtos', 'products' => $products]);


    }

    public function createProduct(Request $request, Response $response) {
        return $this->getView()->render($response, $this->setView('product/CreateProductView'));
    }

    public function registerProduct() {

    }

    public function edit(string $id) {
        // Lógica para editar um produto

       
    }

    public function postEdit(string $id) {
        // Lógica para salvar as alterações do produto
        $nome = $_POST['name'] ?? '';
        $preco = $_POST['price'] ?? '';
        $codigo = $_POST['cod_product'] ?? '';

        $productModel = new ProductModel();
        $productModel->Update('produtos', $id, [
            'nome' => $nome,
            'preco' => $preco,
            'cod_produto' => $codigo
        ]);

        header("Location: /listar-produtos");
        exit();
    }

    public function delete(string $id) {
        // Lógica para deletar um produto
        $productModel = new ProductModel();
        $productModel->Delete('produtos', $id);

        header("Location: /listar-produtos");
        exit();
    }
}

