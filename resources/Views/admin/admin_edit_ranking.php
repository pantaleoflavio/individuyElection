<!-- resources/Views/admin/admin_edit_ranking.php -->
<?php
if (isset($_GET['id_ranking'])) {
    $rankingId = $_GET['id_ranking'];
    $ranking = $rankingController->getRankingPerId($rankingId);
    $categories = $categoryController->getAllCategories();
    if (!$ranking) {
        echo "<script>alert('Ranking non trovato.'); window.location.href='" . ROOT . "/index.php?page=admin_ranking';</script>";
    }
}


if (isset($_POST['save_ranking'])) {
    // Assumi che il form invii tutti questi dati
    $rankingName = $_POST['rankingName'];
    $description = $_POST['description'];
    $rankingType = $_POST['rankingType'];
    $status = $_POST['status'];
    $categoryId = isset($_POST['category_id']) && $_POST['category_id'] !== '' ? $_POST['category_id'] : null;
    $includeInactive = $_POST['include_inactive'];

    $result = $rankingController->updateRanking($rankingId, $rankingName, $description, $rankingType, $status, $categoryId, $includeInactive);

    if ($result) {
        echo "<script>alert('Ranking aggiornato con successo.');</script>";
        echo "<script>window.location.href='/index.php?page=admin_ranking'</script>";
    } else {
        echo "<script>alert('Errore durante l'aggiornamento del ranking.');</script>";
    }
}
?>

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <h1>Edita il Ranking</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="rankingName">Nome Ranking:</label>
                <input type="text" name="rankingName" id="rankingName" value="<?php echo htmlspecialchars($ranking->name); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Descrizione:</label>
                <textarea name="description" id="description" required><?php echo htmlspecialchars($ranking->description); ?></textarea>
            </div>
            <div class="form-group">
                <label for="rankingType">Tipo di classifica:</label>
                <select class="form-control" id="rankingType" name="rankingType">
                    <option value="wrestler" <?php echo $ranking->rankingType === 'wrestler' ? 'selected' : ''; ?>>Wrestler</option>
                    <option value="tag team" <?php echo $ranking->rankingType === 'tag team' ? 'selected' : ''; ?>>Tag Team</option>
                    <option value="federation" <?php echo $ranking->rankingType === 'federation' ? 'selected' : ''; ?>>Federazione</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                    <option value="1" <?php echo $ranking->status === '1' ? 'selected' : ''; ?>>Attivo</option>
                    <option value="0" <?php echo $ranking->status === '0' ? 'selected' : ''; ?>>Inattivo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Categoria:</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="">Nessuna Categoria</option>
                    <?php
                    foreach ($categories as $category) {
                        $selected = $ranking->categoryId === $category['category_id'] ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($category['category_id']) . "' $selected>" . htmlspecialchars($category['name']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Includere wrestler inattivi:</label>
                <div>
                    <input type="radio" id="include_inactive_yes" name="include_inactive" value="1" <?php echo $ranking->includeInactive == '1' ? 'checked' : ''; ?>>
                    <label for="include_inactive_yes">Sì</label>
                </div>
                <div>
                    <input type="radio" id="include_inactive_no" name="include_inactive" value="0" <?php echo $ranking->includeInactive == '0' ? 'checked' : ''; ?>>
                    <label for="include_inactive_no">No</label>
                </div>
            </div>
            <button type="submit" name="save_ranking" class="btn btn-primary">Salva Modifiche</button>
        </form>
    </div>
</div>