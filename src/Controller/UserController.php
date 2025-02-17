<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Attributes\DefaultEntity;
use Core\Attributes\Route;
use Core\Controller\Controller;
use Core\Http\Response;

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
            return $this->redirectToRoute('pizzas');
        }
        return $this->render('user/register', []);
    }

}