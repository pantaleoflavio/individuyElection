<!-- resources/Views/admin/admin_wrestler.php -->

<?php
$wrestlers = $wrestlerController->getAllWrestlers();
$categories = $categoryController->getAllCategories();
$federations = $federationController->getAllFederations();

// Gestione del POST per aggiungere o modificare un wrestler
if (isset($_POST['add_wrestler'])) {
    $name = $_POST['name'];
    $country = $_POST['country'];
    $categoryId = !empty($_POST['category_id']) ? $_POST['category_id'] : NULL;
    $federationId = !empty($_POST['federation_id']) ? $_POST['federation_id'] : NULL;

    $result = $wrestlerController->addWrestler($name, $country, $categoryId, $federationId);
    if ($result) {
        echo "<script>alert('Wrestler aggiunto con successo!')</script>";
        // Ricarica dopo l'inserimento
        $wrestlers = $wrestlerController->getAllWrestlers();
    } else {
        echo "<script>alert('Errore nell'aggiunta del wrestler.')</script>";
    }
}

?>
<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <div class="container">
            <h1>Admin - Wrestler Management</h1>
            <div class="row">
                <div class="col-md-6">
                    <h2>Lista Wrestler</h2>
                    <ul>
                        <?php foreach ($wrestlers as $wrestler): ?>
                            <li>   
                                <?php echo htmlspecialchars($wrestler['name']); ?> - 
                                <?php echo htmlspecialchars($wrestler['category_name']); ?> - 
                                <?php echo htmlspecialchars($wrestler['country']); ?> - 
                                <?php echo htmlspecialchars($wrestler['federation_name']); ?> - 
                                <a href="index.php?page=admin_edit_wrestler&id_wrestler=<?php echo $wrestler['id_wrestler']; ?>">Modifica</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h2>Aggiungi Wrestler</h2>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="" /> <!-- Usato per modificare -->
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Paese:</label>
                            <input type="text" name="country" id="country">
                        </div>
                        <div class="form-group">
                            <label for="category">Categoria:</label>
                            <select name="category_id" id="category">
                                <option value="">Seleziona Categoria</option>
                                <option value="">Pesi Massimi</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['category_id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="federation">Federazione:</label>
                            <select name="federation_id" id="federation">
                                <option value="">Seleziona Federazione</option>
                                <?php foreach ($federations as $federation): ?>
                                    <option value="<?php echo $federation['id_federation']; ?>"><?php echo htmlspecialchars($federation['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" name="add_wrestler" class="btn btn-primary">Salva</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
