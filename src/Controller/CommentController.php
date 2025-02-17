<?php

namespace App\Controller;

use App\Entity\Comment;
use Attributes\DefaultEntity;
use Attributes\TargetEntity;
use Core\Controller\Controller;

#[DefaultEntity(entityName: Comment::class)]
class CommentController extends Controller
{

}