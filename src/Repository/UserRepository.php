<?php

namespace App\Repository;

use App\Entity\User;
use Attributes\TargetEntity;
use Attributes\TargetRepository;
use Core\Repository\Repository;
use PDO;

#[TargetEntity(entityName: User::class)]
class UserRepository extends Repository
{
    public function findByName(string $name): ?User
    {
        $query =$this->pdo->prepare("SELECT * FROM users WHERE name = :name");
        $query->execute([
            "name" => $name
        ]);
        $query->setFetchMode(PDO::FETCH_CLASS, User::class);
        return $query->fetch();

    }
    public function save(User $user):int
    {
        $query = $this->pdo->prepare("INSERT INTO $this->tableName (name, password) VALUES (:name, :password)");
        $query->execute([
            "name" => $user->getName(),
            "password" => $user->getPassword()
        ]);
        return $this->pdo->lastInsertId();
    }
}