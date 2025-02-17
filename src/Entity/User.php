<?php

namespace App\Entity;
use App\Repository\UserRepository;
use Attributes\TargetEntity;
use Attributes\TargetRepository;
use Core\Attributes\Table;

#[Table(name: 'users')]
#[TargetRepository(repoName:UserRepository::class)]
class User
{
    private int $id;

    private string $name;

    private string $password;

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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}