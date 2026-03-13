<?php 
    namespace app\core;

    class Controller 
    {
        //atributos

        //metodos

        public function render($path, $view, $data = []) {
            $viewFile = __DIR__ . "/../views/$path/$view.php";
            if (!file_exists($viewFile)) {
                throw new \Exception("Arquivo de view não encontrado: $viewFile");
            }
            extract($data);
            require_once $viewFile;
        }
    }
?>