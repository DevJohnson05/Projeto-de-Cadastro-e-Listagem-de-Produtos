<?php

namespace app\models\outflows\entities;

class OutflowEntity
{
    public ?int $id;
    public ?int $product_id;
    public ?float $quantidade;
    public ?string $observacao;
    public ?string $created_at;
}
