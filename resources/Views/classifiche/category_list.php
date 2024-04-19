<!-- resources/Views/classifiche/category_list.php -->
<?php

$categories = $categoryController->getAllCategories();

?>
<div class="container">

    <h1>Stili di Wrestling</h1>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><a href="index.php?page=lista_candidati&id_cat=<?php echo $category['category_id']; ?>"><?php echo htmlspecialchars($category['name']); ?></a></li>
        <?php endforeach; ?>
        <li><a href="index.php?page=lista_candidati&id_cat=">Pesi Massimi</a></li>
    </ul>
</div>