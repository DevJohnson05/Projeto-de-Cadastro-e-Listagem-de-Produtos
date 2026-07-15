<?php

namespace app\models\user\entities;


use app\core\database\entities\AbstractEntity;
/**
 * @property ?string $name
 * @property ?string $email
 * @property ?string $password
 * @property ?int $id
 */
class UserEntity extends AbstractEntity
{
    protected ?string $name;
    protected ?string $email;
    protected ?string $password;
    protected ?int $id;

    public function getId(): ?int {
        return $this->id ?? null;
    }
    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }
    public function getName(): ?string {
        return $this->name ?? null;
    }
    public function setName(?string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->email ?? null;
    }
    public function setEmail(?string $email): self {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new \Exception('email not valid format');
            die();
        }
        $this->email = $email;
        return $this;
    }
    public function getPassword(): ?string {
        return $this->password ?? null;
    }
    public function setPassword(?string $password): self {
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $passwordhash;
        return $this;
    }
}
