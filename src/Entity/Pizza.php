<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use App\Repository\PizzaRepository;
use Attributes\TargetRepository;
use Core\Attributes\Table;

#[Table(name: 'pizzas')]
#[TargetRepository(repoName: PizzaRepository::class)]
class Pizza
{
    private int $id;
    private string $name;
    private string $description;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getComments()
    {
        $commentRepository = new CommentRepository();
        return $commentRepository->getCommentsByPizza($this);
    }
}