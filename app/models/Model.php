<?php

namespace app\models;

use app\core\database\Connection;
use PDO;

class Model
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getConnection();
    }
}
