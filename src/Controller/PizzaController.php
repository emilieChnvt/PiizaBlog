<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\PizzaType;
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

    #[Route(uri: "/pizza/show", routeName: "pizzas_show", methods: ["GET"])]
    public function show(): Response
    {
        $id=$this->getRequest()->get(["id"=>"number"]);
        if(!$id){ return $this->redirectToRoute("pizzas");}
        $pizza = $this->getRepository()->find($id);
        if(!$pizza){ return $this->redirectToRoute("pizzas");}


        return $this->render('pizza/show', [
            'pizza' => $pizza
        ]);
    }

    #[Route(uri: "/pizza/update", routeName: "pizza_update")]
    public function update(): Response
    {
        $id=$this->getRequest()->get(["id"=>"number"]);
        if(!$id){ return $this->redirectToRoute("pizzas");}
        $pizza = $this->getRepository()->find($id);
        if(!$pizza){ return $this->redirectToRoute("pizzas");}


        $pizzaForm = new PizzaType();
       if($pizzaForm->isSubmitted()){
           $pizza->setName($pizzaForm->getValue("name"));
           $pizza->setDescription($pizzaForm->getValue("description"));
           $this->getRepository()->update($pizza);

           return $this->redirectToRoute("pizzas_show", ["id"=>$id]);
       }
       return $this->render('pizza/update', [
           'pizza' => $pizza
       ]);


    }

    #[Route(uri: '/pizza/delete',routeName: "pizza_delete")]
    public function delete(): Response
    {
        $id= $this->getRequest()->get(["id"=>"number"]);
        if(!$id){ return $this->redirectToRoute("pizzas");}
        $pizza = $this->getRepository()->find($id);
        if(!$pizza){ return $this->redirectToRoute("pizzas");}

        $this->getRepository()->delete($pizza);
        return $this->redirectToRoute("pizzas");
    }
}