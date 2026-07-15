<?php

namespace app\models\products;

use app\models\Model;
use app\service\ProductService;
use PDO;

class ProductModel extends Model
{
    protected string $table = 'produtos';
    protected ProductService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new ProductService();
    }

    public function create_product(array $data): ?array
    {
        $validated = $this->service->validateProduct($data);
        if (!$validated) {
            return null;
        }

        $validated['creat_at'] = date('Y-m-d H:i:s');
        $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->table} (nome, cod_produto, quantidade, un_medida, data_valid, creat_at) VALUES (:nome, :cod_produto, :quantidade, :un_medida, :data_valid, :creat_at)"
        );
        $stmt->execute($validated);

        return $this->findById((int) $this->pdo->lastInsertId());
    }

    public function list_all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        return $product ?: null;
    }

    public function update_product(int $id, array $data): bool
    {
        $validated = $this->service->validateProduct($data);
        if (!$validated) {
            return false;
        }

        $stmt = $this->pdo->prepare(
            "UPDATE {$this->table} SET nome = :nome, cod_produto = :cod_produto, quantidade = :quantidade, un_medida = :un_medida, data_valid = :data_valid WHERE id = :id"
        );

        return $stmt->execute([
            'nome' => $validated['nome'],
            'cod_produto' => $validated['cod_produto'],
            'quantidade' => $validated['quantidade'],
            'un_medida' => $validated['un_medida'],
            'data_valid' => $validated['data_valid'],
            'id' => $id,
        ]);
    }

    public function delete_product(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function outflow_product(int $id, float $quantity): bool
    {
        $product = $this->findById($id);
        if (!$product) {
            return false;
        }

        $currentQuantity = (float) ($product['quantidade'] ?? 0);
        if ($currentQuantity < $quantity) {
            return false;
        }

        $newQuantity = $currentQuantity - $quantity;
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET quantidade = :quantidade WHERE id = :id");

        return $stmt->execute([
            'quantidade' => $newQuantity,
            'id' => $id,
        ]);
    }
}
