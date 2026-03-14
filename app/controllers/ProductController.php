<?php 
    namespace app\controllers;

use app\core\Controller;
use app\models\products\ProductModel;

    class ProductController extends Controller
    {
        public function list() {

            $productModel = new ProductModel();
            $products = $productModel->All('produtos');

            $this->render('products', 'list', ['title' => 'Listagem de Produtos', 'products' => $products]);


        }

        public function create() {
            $this->render('products', 'create', ['title' => 'Cadastrar Produto']);
        }

        public function postCreate() {
            // Lógica para salvar o produto
            $nome = $_POST['name'] ?? '';
            $preco = $_POST['price'] ?? '';
            $codigo = $_POST['cod_product'] ?? '';
            $un_medida = $_POST['un_medida'] ?? '';

            $productModel = new ProductModel();
            $productModel->Create('produtos', [
                'nome' => $nome,
                'preco' => $preco,
                'cod_produto' => $codigo,
                'un_medida' => $un_medida
            ]);

            header("Location: /listar-produtos");
            exit();
        }

        public function edit($id) {
            // Lógica para editar um produto

            $productModel = new ProductModel();
            $product = $productModel->Find('produtos', $id);
            $this->render('products', 'edit', ['title' => 'Página de Edição', 'product' => $product]);
        }

        public function postEdit($id) {
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
    }

?>