<?php 
    namespace app\models;

    use app\core\Database;

    class Model
    {
        protected $db;

        public function __construct()
        {
            $this->db = new Database();
        }

       public function Find($table, $id)
       {
            $pdo = $this->db->getPdo();
            $stmt = $pdo->prepare("SELECT * FROM $table WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(\PDO::FETCH_OBJ);
       }

        public function All($table)
        {
            $pdo = $this->db->getPdo();
            $stmt = $pdo->query("SELECT * FROM $table");
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }

        public function Create($table, $data)
        {
            $pdo = $this->db->getPdo();
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));
            $stmt = $pdo->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
            return $stmt->execute($data);
        }

            public function Update($table, $id, $data)
            {
                $pdo = $this->db->getPdo();
                $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
                $stmt = $pdo->prepare("UPDATE $table SET $setClause WHERE id = :id");
                return $stmt->execute(array_merge($data, ['id' => $id]));
            }

            public function Delete($table, $id)
            {
                $pdo = $this->db->getPdo();
                $stmt = $pdo->prepare("DELETE FROM $table WHERE id = :id");
                return $stmt->execute(['id' => $id]);
            }

    }
?>