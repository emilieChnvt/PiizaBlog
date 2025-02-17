
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
        </div>
        <?php endforeach;?>


</div>