<?php

namespace App\Repository;

use App\Entity\Pizza;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Pizza::class)]
class PizzaRepository extends Repository
{
    public function update(Pizza $pizza):int
    {
        $query = $this->pdo->prepare("UPDATE $this->tableName SET name = :name, description = :description, user_id = :user_id WHERE id = :id");
        $query->execute([
            "name" => $pizza->getName(),
            "description" => $pizza->getDescription(),
            "id" => $pizza->getId(),
            "user_id" => $pizza->getUserId(),
        ]);
        return $pizza->getId();
    }

    public function save(Pizza $pizza):int
    {
        $query = $this->pdo->prepare("INSERT INTO $this->tableName (name, description, user_id) VALUES (:name, :description, :user_id)");
        $query->execute([
            "name" => $pizza->getName(),
            "description" => $pizza->getDescription(),
            "user_id" => $pizza->getUserId()
        ]);
        return $this->pdo->lastInsertId();
    }
}