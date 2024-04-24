<!-- resources/Views/admin/admin_federation.php -->

<?php
$federations = $federationController->getAllFederations();

if (isset($_POST['add_federation'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    if (!empty($name)) {
        $result = $federationController->addFederation($name, $description);
        if ($result) {
            echo "<script>alert('Federazione aggiunta con successo!')</script>";
            $federations = $federationController->getAllFederations();
        } else {
            echo "<script>alert('Errore durante l'aggiornamento della federazione.')</script>";
        }
    } else {
        echo "<script>alert('Il nome della federazione non può essere vuoto')</script>";
    }
}

if (isset($_POST['delete'])) {
    $federationId = $_POST['id_federation'];

    $result = $federationController->deleteFederation($federationId);
    
    if ($result) {
        //echo 'ok';
        echo "<script>alert('Federazione eliminata con successo.'); window.location.href='index.php?page=admin_federation';</script>";
    } else {
        echo "<script>alert('Errore nell'eliminazione della Federazione.')</script>";
    }
}

?>

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <h1>Admin - Gestione Federazioni</h1>

        <div class="row">
            <div class="col-md-12">
                <h2>Lista Federazioni</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>descrizione</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($federations as $federation): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($federation['name']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($federation['description']); ?>
                                </td>
                                <td>
                                    <a href="index.php?page=admin_edit_federation&id_federation=<?php echo $federation['id_federation']; ?>">Modifica</a>
                                </td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_federation" value="<?php echo $federation['id_federation']; ?>">
                                        <button class="btn btn-secondary" type="submit" name="delete" onclick="return confirm('Sei sicuro di voler eliminare questa federazione?');">Elimina</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <h2>Aggiungi Federazione</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descrizione:</label>
                        <textarea name="description" id="description" rows="4"></textarea>
                    </div>
                    <button type="submit" name="add_federation" class="btn btn-primary">Aggiungi</button>
                </form>
            </div>
        </div>

    </div>
</div>