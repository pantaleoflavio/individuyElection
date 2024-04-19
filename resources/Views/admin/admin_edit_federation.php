<!-- resources/Views/admin/admin_edit_federation.php -->

<?php
$federation = null;
$error = '';

if (isset($_GET['id_federation'])) {
    $federation = $federationController->getFederationPerId($_GET['id_federation']);
    if (!$federation) {
        $error = 'Federazione non trovata.';
    }
} else {
    $error = 'Nessun ID federazione specificato.';
}

if (isset($_POST['save_federation'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    if (!empty($name)) {
        $result = $federationController->updateFederation($_GET['id_federation'], $name, $description);
        if ($result) {
            echo "<script>alert('Federazione aggiornata con successo!');</script>";
            // Ricarica la federazione aggiornata
            $federation = $federationController->getFederationPerId($_GET['id_federation']);
        } else {
            echo "<script>alert('Errore durante l'aggiornamento della federazione.');</script>";
        }
    } else {
        echo "<script>alert('Il nome della federazione non può essere vuoto.');</script>";
    }
}

?>

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <h1>Edita la Federazione</h1>
        <?php if ($error): ?>
            <p><?php echo $error; ?></p>
        <?php else: ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Nome Federazione:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($federation->name); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Descrizione:</label>
                <textarea name="description" id="description" required><?php echo htmlspecialchars($federation->description); ?></textarea>
            </div>
            <button type="submit" name="save_federation" class="btn btn-primary">Salva Modifiche</button>
        </form>
        <?php endif; ?>
    </div>
</div>
