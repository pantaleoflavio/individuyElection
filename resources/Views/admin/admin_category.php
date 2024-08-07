<!-- resources/Views/admin/admin_category.php -->

<?php
$categories = $categoryController->getAllCategories();

if (isset($_POST['add_category'])) {
    $name = $_POST['name'];
    if (!empty($name)) {
        $result = $categoryController->addCategory($name);
        if ($result) {
            echo "<script>alert('Categoria aggiunta con successo!')</script>";
            // Ricarica dopo l'inserimento
            $categories = $categoryController->getAllCategories();
        } else {
            echo "<script>alert('Errore durante l'aggiunta della categoria.')</script>";
        }
    } else {
        echo "<script>alert('Il nome della categoria non può essere vuoto.')</script>";
    }
}

if (isset($_POST['delete'])) {
    $categoryId = $_POST['id_category'];

    $result = $categoryController->deleteCategory($categoryId);

    if ($result) {
        //echo 'ok';
        echo "<script>alert('Categoria eliminata con successo.'); window.location.href='/index.php?page=admin_category';</script>";
    } else {
        echo "<script>alert('Errore nell'eliminazione della categoria.')</script>";
    }
}

?>

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <h1>Admin - Gestione Categorie</h1>
        <!-- Category List-->
        <div class="row">
            <div class="col-md-12">
                <h2>Lista Stili</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titolo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </td>
                                <td>
                                    <a href="index.php?page=admin_edit_category&id_category=<?php echo $category['category_id']; ?>">Modifica</a>
                                </td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_category" value="<?php echo $category['category_id']; ?>">
                                        <button class="btn btn-secondary" type="submit" name="delete" onclick="return confirm('Sei sicuro di voler eliminare questa categoria?');">Elimina</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
                <!-- Category Adding-->
        <div class="row">
            <div class="col-md-12">
                <h2>Aggiungi Categoria</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Nome Categoria:</label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    <button type="submit" name="add_category" class="btn btn-primary">Aggiungi</button>
                </form>
            </div>
        </div>
    </div>
</div>