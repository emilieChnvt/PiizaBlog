<div class="border">
    <form action="/comment/update?id=<?=$comment->getId()?>" method="post">
        <input type="text" name="content" class="text" value="<?=$comment->getContent()?>">
        <input type="hidden" name="pizza_id" class="text" value="<?= $comment->getPizzaId()?>">
        <button class="submit">edit comment</button>
    </form>
</div>