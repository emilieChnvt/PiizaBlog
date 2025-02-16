
<div class="d-flex">
    <?php foreach ($pizzas as $pizza): ?>
        <div class="border p-5">
            <h2><?= $pizza->getname()?></h2>
            <p><?= $pizza->getDescription()?></p>
            <div class="">
                <a href="/pizza/show?id=<?=$pizza->getId()?>" >see</a>
                <a href="/pizza/update?id=<?=$pizza->getId()?>">edit</a>
                <a href="/pizza/delete??id=<?=$pizza->getId()?>">delete</a>

            </div>
        </div>
    <?php endforeach; ?>
</div>