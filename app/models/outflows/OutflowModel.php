<?php

namespace app\models\outflows;

use app\models\Model;
use PDO;

class OutflowModel extends Model
{
    protected string $table = 'outflows';

    public function create(array $data): ?array
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->table} (product_id, quantidade, observacao, created_at) 
             VALUES (:product_id, :quantidade, :observacao, :created_at)"
        );
        $stmt->execute([
            'product_id' => $data['product_id'],
            'quantidade' => $data['quantidade'],
            'observacao' => $data['observacao'] ?? null,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->findById((int) $this->pdo->lastInsertId());
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    public function listAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
}
