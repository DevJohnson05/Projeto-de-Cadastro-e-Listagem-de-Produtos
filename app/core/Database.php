<?php 
    namespace app\core;

    class Database
    {
        private $pdo;

        private $config = [];

        public function criarConexao()
        {
            $this->config = require __DIR__ . "/../../config.php";
            $dbConfig = $this->config['database'];

            try {
                $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
                $this->pdo = new \PDO($dsn, $dbConfig['username'], $dbConfig['password']);
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }

        public function getPdo()
        {
            if (!$this->pdo) {
                $this->criarConexao();
            }
            return $this->pdo;
        }
    }
?>