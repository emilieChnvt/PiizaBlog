<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Attributes\DefaultEntity;
use Attributes\TargetRepository;
use Core\Attributes\Route;
use Core\Controller\Controller;
use Core\Http\Response;

#[DefaultEntity(entityName: Pizza::class)]

class PizzaController extends Controller
{
    #[Route(uri: "/", routeName: "pizzas", methods: ["GET"])]
    public function index():Response
    {
        $pizzas = $this->getRepository()->findAll();
        return $this->render('pizza/index', [
            'pizzas' => $pizzas
        ]);
    }
}