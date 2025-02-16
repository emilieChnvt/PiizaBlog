<?php

namespace App\Repository;

use App\Entity\Pizza;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Pizza::class)]
class PizzaRepository extends Repository
{

}