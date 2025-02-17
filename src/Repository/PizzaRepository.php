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
        $query = $this->pdo->prepare("UPDATE $this->tableName SET name = :name, description = :description WHERE id = :id");
        $query->execute([
            "name" => $pizza->getName(),
            "description" => $pizza->getDescription(),
            "id" => $pizza->getId()
        ]);
        return $pizza->getId();
    }
}