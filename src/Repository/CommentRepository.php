<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Pizza;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Comment::class)]
class CommentRepository extends Repository
{
    public function getCommentsByPizza(Pizza $pizza): array
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE pizza_id = :pizza_id");
        $query->execute([
            'pizza_id' => $pizza->getId()
        ]);
        return $query->fetchAll(\PDO::FETCH_CLASS, $this->targetEntity);
    }

    public function save(Comment $comment): int
    {
        $query =$this->pdo->prepare("INSERT INTO $this->tableName (content, pizza_id) VALUES (:content, :pizza_id)");
        $query->execute([
            'content' => $comment->getContent(),
            'pizza_id' => $comment->getPizzaId()
        ]);
        return $this->pdo->lastInsertId();
    }
}