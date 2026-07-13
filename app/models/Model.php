<?php 
namespace app\models;

use PDO;

class Model
{
    protected PDO $pdo;

    public function __construct() {
        $conn = new ConnectionDB;
        $conn->setConnectionDB([
            'dbname' => 'sistemaDeCadastroElistagem',
            'user' => 'estudante',
            'password' => '2467'
        ]);
        if (!$this->pdo) {
            $this->pdo = $conn->getConnectionDB();
        }
    }
}
