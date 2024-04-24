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
    $is_active = $_POST['is_active'];
    
    $result = $wrestlerController->addWrestler($name, $country, $categoryId, $federationId, $is_active);
    if ($result) {
        echo "<script>alert('Wrestler aggiunto con successo!')</script>";
        // Ricarica dopo l'inserimento
        $wrestlers = $wrestlerController->getAllWrestlers();
    } else {
        echo "<script>alert('Errore nell'aggiunta del wrestler.')</script>";
    }
}

if (isset($_POST['delete'])) {
    $wrestlerId = $_POST['id_wrestler'];

    $result = $wrestlerController->deleteWrestler($wrestlerId);

    if ($result) {
        //echo 'ok';
        echo "<script>alert('Wrestler eliminato con successo.'); window.location.href='index.php?page=admin_wrestler';</script>";
    } else {
        echo "<script>alert('Errore nell'eliminazione del Wrestler.')</script>";
    }
}

?>
<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
            <h1>Admin - Wrestler Management</h1>
            
            <!-- Wrestler List-->
            <div class="row">
                <div class="col-md-12">
                    <h2>Lista Wrestler</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Stile</th>
                                <th>Nazione</th>
                                <th>nome federazione</th>
                                <th>Attivita</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($wrestlers as $wrestler): ?>
                                <tr>
                                    <td>
                                        <?php echo htmlspecialchars($wrestler['name']); ?> 
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($wrestler['category_name']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($wrestler['country']); ?> 
                                    </td>
                                    <td>
                                        <?php
                                            echo (!empty($wrestler['federation_name'])) ? htmlspecialchars($wrestler['federation_name']) : 'Nessuna federazione';
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($wrestler['is_active'] === 1): ?>
                                            <?php echo 'in attivita'; ?>
                                        <?php else : ?>
                                            <?php echo 'ritirato'; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="index.php?page=admin_edit_wrestler&id_wrestler=<?php echo $wrestler['id_wrestler']; ?>">Modifica</a>
                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id_wrestler" value="<?php echo $wrestler['id_wrestler']; ?>">
                                            <button class="btn btn-secondary" type="submit" name="delete" onclick="return confirm('Sei sicuro di voler eliminare questo Wrestler?');">Elimina</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
             </div>

            <!-- Wrestler Adding-->
            <div class="row">
                <div class="col-md-12">
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
                        <div class="form-group">
                            <label for="is_active">Stato Lottatore:</label>
                            <select name="is_active" id="is_active">
                                <option value="1">In attivita</option>
                                <option value="0">Ritirato</option>
                            </select>
                        </div>
                        <button type="submit" name="add_wrestler" class="btn btn-primary">Salva</button>
                    </form>
                </div>
            </div>


    </div>
</div>
