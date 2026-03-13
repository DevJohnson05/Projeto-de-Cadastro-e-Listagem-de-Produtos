<?php 
    namespace app\core;
    use app\ExceptionsApp\ExceptionRota;
    class Router 
    {
        //atributos
        private $routes = [];

        //metodos
       

        public function dispatch() {
            try {
                return $this->processarRota();
            } catch (ExceptionRota $e) {
                http_response_code($e->getCode());
                echo $e->getMessage();
            } catch (\Exception $e) {
                http_response_code(500);
                echo "Erro interno do servidor: " . $e->getMessage();
            }
        }

        private function getURI() {
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }

        private function getMethod() {
            return strtolower($_SERVER['REQUEST_METHOD']);
        }

        private function getSegments() {
            $uri = $this->getURI();
            return explode('/', trim($uri, '/'));
        }

        public function add($method, $uri, $action) {
            //adicionar a rota
            $method = strtolower($method);
            $this->routes[$method][$uri] = $action;

        }

        private function rota_existe() {
            $uri = $this->getURI();
            $method = strtolower($this->getMethod());
    
            // Primeiro, tenta match exato
            if (isset($this->routes[$method][$uri])) {
                return ['action' => $this->routes[$method][$uri], 'params' => []];
            }
    
            // Se não encontrou, tenta match com parâmetros
            foreach ($this->routes[$method] as $routePattern => $action) {
                $pattern = preg_replace('/\{([^}]+)\}/', '([^/]+)', $routePattern);
                $pattern = '#^' . $pattern . '$#';
                if (preg_match($pattern, $uri, $matches)) {
                    array_shift($matches); // Remove o match completo
                    return ['action' => $action, 'params' => $matches];
                }
            }
    
            throw new \Exception("Rota não encontrada", 404);
        }

        private function carregarController($controllerName, $actionName, $params = []) {
            $controllerClass = "app\\controllers\\$controllerName"; // ou outra namespace
            if (!class_exists($controllerClass)) {
                $file = __DIR__ . "/../controllers/$controllerName.php";
                if (!file_exists($file)) {
                    throw new \Exception("Arquivo do controller não encontrado: $file");
                }
                require_once $file;
                if (!class_exists($controllerClass)) {
                    throw new \Exception("Classe do controller não encontrada: $controllerClass");
                }
            }

            $instance = new $controllerClass();
            if (!method_exists($instance, $actionName)) {
                throw new \Exception("Ação não encontrada: $actionName");
            }
            return call_user_func_array([$instance, $actionName], $params);
        }

        private function processarRota() {
            $routeData = $this->rota_existe();
            list($controllerName, $actionName) = explode('@', $routeData['action']);
            return $this->carregarController($controllerName, $actionName, $routeData['params']);
        }


        public function dump() {
            $route = $this->rota_existe();
            $uri = $this->getURI();
            $method = strtolower($this->getMethod());
            $routes = $this->routes;
            echo "<pre>";
            var_dump($route);
            var_dump($uri);
            var_dump($method);
            var_dump($routes);
            echo "</pre>";
        }
    
    }

   
?>