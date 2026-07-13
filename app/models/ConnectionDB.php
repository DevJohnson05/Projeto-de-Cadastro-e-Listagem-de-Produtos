<?php

namespace app\models;

use PDO;
use PDOException;

class ConnectionDB
{
    private PDO $connection;
    /**
     * @param ?array $option['database name', 'user', 'password']
     */
    public function setConnectionDB(?array $option)
    {
        if (empty($option)) {
            return null;
        }

        $dsn = "mysql:host=localhost;dbname={$option['dbname']};charset=utf8mb4";
        $user = $option['user'];
        $password = $option['password'];

        try {
            $this->connection = new PDO($dsn, $user, $password);
            // Configura o PDO para lançar exceções em caso de erros
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexão realizada com sucesso!";
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }

    }

    public function getConnectionDB(): ?PDO 
    {
        if(!$this->connection){
            return null;
        }

        return $this->connection;
    }

}
