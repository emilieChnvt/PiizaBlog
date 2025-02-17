<form action="/pizza/update?id=<?= $pizza->getId()?>" method="post" >
    <input type="text" name="name" class="text" value="<?= $pizza->getName() ?>">
    <input type="text" name="description" class="text" value="<?= $pizza->getDescription() ?>">
    <button class="submit">update</button>
</form>