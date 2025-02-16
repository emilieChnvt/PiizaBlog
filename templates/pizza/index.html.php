
<div class="d-flex">
    <?php foreach ($pizzas as $pizza): ?>
        <div class="border p-5">
            <h2><?= $pizza->getname()?></h2>
            <p><?= $pizza->getDescription()?></p>
        </div>
    <?php endforeach; ?>
</div>