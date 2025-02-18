<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Attributes\DefaultEntity;
use Core\Attributes\Route;
use Core\Controller\Controller;
use Core\Http\Response;
use Core\Repository\Repository;
use Core\Session\Session;

#[DefaultEntity(entityName: User::class)]
class UserController extends Controller
{
    #[Route(uri: "/register", routeName:'register', methods: ["POST", "GET"])]
    public function register():Response
    {

        $userForm = new UserType();
        if($userForm->isSubmitted()) {

            $name = $userForm->getValue("name");
            $existingUser = $this->getRepository()->findByName($name);
            if($existingUser){return $this->render('user/register', [
                'error' => 'Ce nom d\'utilisateur est déjà pris. Veuillez en choisir un autre.'
            ]);}

            $user = new User();
            $user->setName($userForm->getValue('name'));
            $user->setPassword($userForm->getValue('password'));


            $id = $this->getRepository()->save($user);
            return $this->redirectToRoute('login');
        }
        return $this->render('user/register', []);
    }

    #[Route(uri: "/logout", routeName:'logout', methods: ["POST"])]
    public function logout():Response
    {
       $user = $this->getUser();

        if($user){
           $user->logOut();
           return $this->redirectToRoute('pizzas');
       }
        return $this->redirectToRoute('login');
    }

    #[Route(uri: "/login", routeName:'login', methods: ["POST", "GET"])]

    public function login():Response
    {
        \Core\Session\Session::start();
        $userForm = new UserType();
        if($userForm->isSubmitted()) {
            $user = $this->getRepository()->findByName($userForm->getValue("name"));
           if(!$user){return $this->redirectToRoute('login');}

           $id = $user->getId();
           if(!$id){return $this->redirectToRoute('login');}

           $user = $this->getRepository()->find($id);
           if(!$user){return $this->redirectToRoute('login');}

           $success = $user->logIn($userForm->getValue('password'));
           if($success){
               \Core\Session\Session::set("user", [
                   "id" => $user->getId(),
                   "name" => $user->getName(),
               ]);
               return $this->redirectToRoute('pizzas');}
        }
        return $this->render('user/login', []);
    }



}