<!-- resources/Views/admin/admin_edit_category.php -->

<?php
$category = null;
$error = '';

if (isset($_GET['id_category'])) {
    $category = $categoryController->getSingleCategory($_GET['id_category']);
    if (!$category) {
        $error = 'Categoria non trovata.';
    }
} else {
    $error = 'Nessun ID categoria specificato.';
}

if (isset($_POST['save_category'])) {
    $name = $_POST['name'];
    if (!empty($name)) {
        $result = $categoryController->updateCategory($_GET['id_category'], $name);
        if ($result) {
            echo "<script>alert('Categoria aggiornata con successo!')</script>";
            // Ricarica la categoria aggiornata
            $category = $categoryController->getSingleCategory($_GET['id_category']);
        } else {
            echo "<script>alert('Errore durante l'aggiornamento della categoria.')</script>";
        }
    } else {
        echo "<script>alert('Il nome della categoria non può essere vuoto.')</script>";
    }
}

?>

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <h1>Edita la Categoria</h1>
        <?php if ($error): ?>
            <p><?php echo $error; ?></p>
        <?php else: ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Nome Categoria:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($category->categoryName); ?>" required>
            </div>
            <button type="submit" name="save_category" class="btn btn-primary">Salva Modifiche</button>
        </form>
        <?php endif; ?>
    </div>
</div>
