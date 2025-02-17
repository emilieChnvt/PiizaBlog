
<div class="d-flex flex-column ">

        <div class="border p-5 mb-5">
            <h2><?= $pizza->getname()?></h2>
            <p><?= $pizza->getDescription()?></p>
            <div class="">
                <a href="/pizza/update?id=<?=$pizza->getId()?>">edit</a>
                <a href="/pizza/delete??id=<?=$pizza->getId()?>">delete</a>
                <a href="/">return</a>

            </div>
        </div>


        <?php foreach ($pizza->getComments() as $comment):?>
        <div class="border p-4">
            <h4><?=$comment->getContent()?></h4>
            <a href="/comment/update?id=<?=$comment->getId()?>">edit</a>
            <a href="/comment/delete?id=<?=$comment->getId()?>">delete</a>


        </div>
        <?php endforeach;?>

    <div class="border">
        <form action="/comment/add" method="post">
            <input type="text" name="content" class="text">
            <input type="hidden" name="pizza_id" class="text" value="<?= $pizza->getId()?>">
            <button class="submit">add comment</button>
        </form>
    </div>


</div>