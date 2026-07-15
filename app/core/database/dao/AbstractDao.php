<?php

namespace app\core\database\dao;

use app\core\database\Connection;
use app\core\database\entities\AbstractEntity;
use app\core\database\EntityManager;

/**
 * @template TEntity of AbstractEntity 
 */
abstract class AbstractDao
{
    protected \PDO $connection;
    protected string $table;
    protected string $entity;
    protected EntityManager $entityManager;

    public function __construct() {
        $this->connection = Connection::getConnection();
        $this->entityManager = new EntityManager;
    }
    /**
     * @return TEntity|null
     */
    public function FindById(int $id, string $fields = '*'): ?AbstractEntity{
        return $this->FindBy('id', $id, $fields);
    }
    /**
     * @return TEntity[]|null
     */
    public function FindAll(string $fields='*'): ?array 
    {
        $sql = "SELECT {$fields} from {$this->table}";
        $query_select = $this->connection->query($sql);
        $dataFetchAll = $query_select->fetchAll();
        return $this->entityManager->MapToEntity($this->entity ,$dataFetchAll);    
    }
    /**
     * @return TEntity|null
     */
    public function FindBy(string $field, mixed $value, string $fields = '*'): ?AbstractEntity
    {
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$field} = :{$field}";
        $prepare = $this->connection->prepare($sql);
        $prepare->execute([
            $field => $value
        ]);

        $dataFetch = $prepare->fetch();
        if (!$dataFetch) {
            return null;
        }

        $entity = $this->entityManager->MapToEntity($this->entity, $dataFetch);
        $this->entityManager->snapshotEntityManager->takeSnapshot($entity);

        return $entity;
    }

    public function insert(array|AbstractEntity $dataArrayOrEntity): AbstractEntity 
    {
        $data = $this->entityManager->normalizeDatatoArray($dataArrayOrEntity);

        $fields = implode(',', array_keys($data));
        $placeholders = ':'.implode(',:', array_keys($data));
        $sql = "INSERT INTO {$this->table} ({$fields}) VAlUES ({$placeholders})";
        $prepare = $this->connection->prepare($sql);
        $prepare->execute($data);
        $lastInsertId = $this->connection->lastInsertId();
        return $this->FindById($lastInsertId);
    }

    public function update(?AbstractEntity $entity): ?int
    {
        if (is_null($entity)) {
            return null;
        }
        $properties = $this->entityManager->snapshotEntityManager->propertiesChanged($entity);
        if (empty($properties)){
            return null;
        }
        $sets = implode(', ', array_map(fn($field) => "{$field} = :{$field}",array_keys($properties)));
        $sql = "UPDATE {$this->table} SET {$sets} WHERE id = :id";
        $prepare = $this->connection->prepare($sql);
        $prepare->execute([
            ... $properties,
            'id' => $entity->id
        ]);
        $this->entityManager->snapshotEntityManager->clearSnapshot();

        return $prepare->rowCount();
    }

    public function delete(?AbstractEntity $entity): ?int
    {
        if (is_null($entity)) {
            return null;
        }
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $prepare = $this->connection->prepare($sql);
        $prepare->execute([
            'id' => $entity->id
        ]);

        return $prepare->rowCount();
    }
    
}
