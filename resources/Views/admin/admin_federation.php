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
?>

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <h1>Admin - Gestione Federazioni</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Lista Federazioni</h2>
                <ul>
                    <?php foreach ($federations as $federation): ?>
                        <li>
                            <?php echo htmlspecialchars($federation['name']); ?> - 
                            <?php echo htmlspecialchars($federation['description']); ?>
                            <a href="index.php?page=admin_edit_federation&id_federation=<?php echo $federation['id_federation']; ?>">Modifica</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-6">
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