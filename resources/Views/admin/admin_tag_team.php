<!-- resources/Views/admin/admin_tag_team.php -->

<?php
$tagTeams = $tagTeamController->getAllTagTeams();
$categories = $categoryController->getAllCategories();
$federations = $federationController->getAllFederations();

// Gestione del POST per aggiungere o modificare un tag team
if (isset($_POST['add_tag_team'])) {
    $name = $_POST['name'];
    $country = $_POST['country'];
    $categoryId = !empty($_POST['category_id']) ? $_POST['category_id'] : NULL;
    $federationId = !empty($_POST['federation_id']) ? $_POST['federation_id'] : NULL;
    $is_active = $_POST['is_active'];
    
    $result = $tagTeamController->addTagTeam($name, $country, $categoryId, $federationId, $is_active);
    if ($result) {
        echo "<script>alert('Tag team aggiunto con successo!')</script>";
        // Ricarica dopo l'inserimento
        $tagTeams = $tagTeamController->getAllTagTeams();
    } else {
        echo "<script>alert('Errore nell'aggiunta del tag team.')</script>";
    }
}

if (isset($_POST['delete'])) {
    $tagTeamId = $_POST['id_tag_team'];

    $result = $tagTeamController->deleteTagTeam($tagTeamId);

    if ($result) {
        //echo 'ok';
        echo "<script>alert('Tag team eliminato con successo.'); window.location.href='index.php?page=admin_tag_team';</script>";
    } else {
        echo "<script>alert('Errore nell'eliminazione del Tag team.')</script>";
    }
}

?>
<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
            <h1>Admin - Tag team Management</h1>
            
            <!-- Tag Team List-->
            <div class="row">
                <div class="col-md-12">
                    <h2>Lista Tag team</h2>
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
                            <?php foreach ($tagTeams as $tagTeam): ?>
                                <tr>
                                    <td>
                                        <?php echo htmlspecialchars($tagTeam['name']); ?> 
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($tagTeam['category_name']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($tagTeam['country']); ?> 
                                    </td>
                                    <td>
                                        <?php
                                            echo (!empty($tagTeam['federation_name'])) ? htmlspecialchars($tagTeam['federation_name']) : 'Nessuna federazione';
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($tagTeam['is_active'] === 1): ?>
                                            <?php echo 'in attivita'; ?>
                                        <?php else : ?>
                                            <?php echo 'ritirato'; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="index.php?page=admin_edit_tag_team&id_tag_team=<?php echo $tagTeam['id_tag_team']; ?>">Modifica</a>
                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id_tag_team" value="<?php echo $tagTeam['id_tag_team']; ?>">
                                            <button class="btn btn-secondary" type="submit" name="delete" onclick="return confirm('Sei sicuro di voler eliminare questo Tag Team?');">Elimina</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
             </div>

            <!-- Tag Team Adding-->
            <div class="row">
                <div class="col-md-12">
                    <h2>Aggiungi Tag Team</h2>
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
                            <label for="is_active">Stato Tag Team:</label>
                            <select name="is_active" id="is_active">
                                <option value="1">In attivita</option>
                                <option value="0">Ritirato</option>
                            </select>
                        </div>
                        <button type="submit" name="add_tag_team" class="btn btn-primary">Salva</button>
                    </form>
                </div>
            </div>


    </div>
</div>
