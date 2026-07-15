<?php

namespace app\models\products\entities;

use app\core\database\entities\AbstractEntity;

/**
 * @property ?int $id
 * @property ?string $nome
 * @property ?string $cod_produto
 * @property ?float $quantidade
 * @property ?string $un_medida
 * @property ?string $data_valid
 * @property ?string $creat_at
 */
class ProductEntity extends AbstractEntity
{
    protected ?int $id;
    protected ?string $nome;
    protected ?string $cod_produto;
    protected ?float $quantidade;
    protected ?string $un_medida;
    protected ?string $data_valid;
    protected ?string $creat_at;

    public function getId(): ?int { return $this->id ?? null; }
    public function setId(?int $id): self { $this->id = $id; return $this; }

    public function getNome(): ?string { return $this->nome ?? null; }
    public function setNome(?string $nome): self { $this->nome = $nome; return $this; }

    public function getCod_produto(): ?string { return $this->cod_produto ?? null; }
    public function setCod_produto(?string $cod): self { $this->cod_produto = $cod; return $this; }

    public function getQuantidade(): ?float { return $this->quantidade ?? null; }
    public function setQuantidade($q): self { $this->quantidade = is_numeric($q) ? (float)$q : null; return $this; }

    public function getUn_medida(): ?string { return $this->un_medida ?? null; }
    public function setUn_medida(?string $u): self { $this->un_medida = $u; return $this; }

    public function getData_valid(): ?string { return $this->data_valid ?? null; }
    public function setData_valid(?string $v): self {
        if ($v === null || $v === '') { $this->data_valid = null; return $this; }
        $d = date_create($v);
        if (!$d) {
            throw new \Exception('Formato de data inválido para data_valid');
        }
        $this->data_valid = $d->format('Y-m-d');
        return $this;
    }

    public function getCreat_at(): ?string { return $this->creat_at ?? null; }
    public function setCreat_at(?string $c): self { $this->creat_at = $c; return $this; }
}
