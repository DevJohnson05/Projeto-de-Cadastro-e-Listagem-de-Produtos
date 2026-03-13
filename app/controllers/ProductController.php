<?php 
    namespace app\controllers;

use app\core\Controller;

    class ProductController extends Controller
    {
        public function list() {
            $this->render('products', 'list', ['title' => 'Listagem de Produtos']);
        }

        public function create() {
            $this->render('products', 'create', ['title' => 'Cadastrar Produto']);
        }

        public function postCreate() {
            // Lógica para salvar o produto
            header("Location: /listar-produtos");
            exit();
        }

        public function edit($id) {
            // Lógica para editar um produto
            echo "Editar produto com ID: $id";
        }
    }

?>