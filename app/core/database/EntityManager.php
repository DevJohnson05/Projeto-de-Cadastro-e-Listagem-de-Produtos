<?php

namespace app\core\database;

use app\core\database\entities\AbstractEntity;
/**
 * @template TEntity of AbstractEntity
 */
class EntityManager
{
    public SnapshotEntityManager $snapshotEntityManager;

    public function __construct() {
       
        $this->snapshotEntityManager = new SnapshotEntityManager;
    }
    /**
     * @param class-string<TEntity> $entity
     * @param  array $datas
     * @return TEntity|TEntity[]
     */
    public function MapToEntity(string $entity, array $datas): array|AbstractEntity {
        if ($this->isSingleArray($datas)){
            return new $entity(function($entityInstance) use ($datas){
                $entityInstance->normalizeArrayToEntity($datas);
            });
        }
        return array_map(function ($datas) use ($entity) {
            return new $entity(function($entityInstance) use ($datas){
                $entityInstance->normalizeArrayToEntity($datas);
            });
        },$datas);
    }
    /**
     * @param array $data
     * @return bool
     */
    private function isSingleArray(array $data): bool {

        return !isset($data[0]);
    }
    /**
     * @param TEntity|array $ArrayOrEntity
     * @return array
     */
    public function normalizeDatatoArray(AbstractEntity|array $ArrayOrEntity) {
        if ($ArrayOrEntity instanceof AbstractEntity){
            return $ArrayOrEntity->EntityToArray();
        }
        
        if (isset($ArrayOrEntity['password'])){
            $ArrayOrEntity['password'] = password_hash($ArrayOrEntity['password'], PASSWORD_DEFAULT);
        }
        return $ArrayOrEntity;
    }
}
