<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Pizza;
use App\Form\CommentType;
use Attributes\DefaultEntity;
use Core\Attributes\Route;
use Core\Controller\Controller;
use Core\Http\Response;
use Core\Session\Session;

#[DefaultEntity(entityName: Comment::class)]
class CommentController extends Controller
{
    #[Route(uri: "/comment/add", routeName: "comment_add", methods: ['POST'])]
    public function save():Response
    {
        $commentForm = new CommentType();

        if($commentForm->isSubmitted());
        {
            $comment = new Comment();
            $comment->setContent($commentForm->getValue('content'));
            $comment->setPizzaId($commentForm->getValue('pizza_id'));
            $comment->setUserId(Session::get("user")['id']);

            $id= $this->getRepository()->save($comment);


            return $this->redirectToRoute("pizzas_show", ["id" => $comment->getPizzaId()]);
        }
        return $this->redirectToRoute("pizzas_show", ["id" => $id]);
    }

    #[Route(uri: "/comment/delete", routeName: "comment_delete", methods: ['POST',"GET"])]
    public function delete():Response
    {
        $id= $this->getRequest()->get(["id"=>"number"]);
        if(!$id){return $this->redirectToRoute("pizzas_show");}
        $comment = $this->getRepository()->find($id);
        if(!$comment){return $this->redirectToRoute("pizzas_show");}

        $this->getRepository()->delete($comment);
        return $this->redirectToRoute("pizzas_show",["id"=>$comment->getPizzaId()]);
    }

    #[Route(uri: "/comment/update", routeName: "pizzas_update", methods: ['POST', 'GET'])]
    public function update():Response
    {
        $id= $this->getRequest()->get(["id"=>"number"]);
        if(!$id){return $this->redirectToRoute("pizzas_show");}
        $comment = $this->getRepository()->find($id);
        if(!$comment){return $this->redirectToRoute("pizzas_show");}
        $commentForm = new CommentType();
        if($commentForm->isSubmitted()){
            $comment->setContent($commentForm->getValue('content'));
            $comment->setPizzaId($commentForm->getValue('pizza_id'));
            $comment->setUserId(Session::get("user")['id']);

            $id= $this->getRepository()->update($comment);
            return $this->redirectToRoute("pizzas_show", ["id" => $comment->getPizzaId()]);
        }
        return $this->render("comment/update",[
            "comment" => $comment,
        ]);
    }
}