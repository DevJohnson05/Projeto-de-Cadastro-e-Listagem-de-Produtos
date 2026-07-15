<?php

namespace app\core\database;

use app\core\database\entities\AbstractEntity;
use ReflectionClass;

class SnapshotEntityManager
{
    protected array $snapshot = [];
    public function takeSnapshot(AbstractEntity $entity) {
        $reflectionClass = new ReflectionClass($entity);
        $properties = $reflectionClass->getProperties();
        foreach ($properties as $property) {
            $name = $property->getName();
            $value = $property->getValue($entity);
            $this->snapshot[$name] = $value;
        }
    }
    public function propertiesChanged(AbstractEntity $entity){
        $propertiesChanged = [];
        foreach ($this->snapshot as $property => $oldValue){
            if (!property_exists($entity, $property) || $property == 'id') {
                continue;
            }
            $newValue = $entity->{$property};

            if ($oldValue != $newValue) {
                $propertiesChanged[$property] = $newValue;
            }
        } 
        return $propertiesChanged;
    }
    public function clearSnapshot() {
        $this->snapshot = [];
    }
}
