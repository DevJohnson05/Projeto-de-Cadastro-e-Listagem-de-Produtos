<?php

namespace app\core\database\entities;

abstract class AbstractEntity
{
    public function __construct(?callable $callback = null) {
        if (!is_null($callback)) {
            $callback($this);
        }
    }
    public function __set(string $property, mixed $value): void
    {
        if (property_exists($this, $property)){
            $method = 'set'. ucfirst($property);
            $this->{$method}($value);
        }
    }
    public function __get(string $property): mixed
    {
        if (property_exists($this, $property)){
            $method = 'get'. ucfirst($property);
            return $this->{$method}();
        }

        return null;
    }
    public function normalizeArrayToEntity(array $datas) {
        foreach ($datas as $property => $value) {
            if(property_exists($this, $property)){
                if($property == 'password'){
                    $this->{$property} = $value;
                    continue;
                }
                $method = 'set'. ucfirst($property);
                $this->{$method}($value);
            }
        }
    }

    public function EntityToArray() {
        return get_object_vars($this);
    }
}
