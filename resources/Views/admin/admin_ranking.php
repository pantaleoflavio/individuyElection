<!-- resources/Views/admin/admin_ranking.php -->

<?php

$rankings = $rankingController->getAllRanking();
$categories = $categoryController->getAllCategories();


if (isset($_POST['add_ranking'])) {
    $rankingName = $_POST['ranking_name'];
    $description = $_POST['description'];
    $rankingType = $_POST['rankingType'];
    $status = $_POST['status'];
    $categoryId = isset($_POST['category_id']) && $_POST['category_id'] !== '' ? $_POST['category_id'] : null;
    $includeInactive = $_POST['include_inactive'];

    $addRanking = $rankingController->addRanking($rankingName, $description, $rankingType, $status, $categoryId, $includeInactive);

    if ($addRanking) {
        echo "<script>alert('Ranking aggiunto con successo!')</script>";
        $rankings = $rankingController->getAllRanking();
    } else {
        echo "<script>alert('Errore.')</script>";
    }
}


if (isset($_POST['delete'])) {
    $rankingId = $_POST['id_ranking'];

    $result = $rankingController->deleteRanking($rankingId);

    if ($result) {
        //echo 'ok';
        echo "<script>alert('Ranking eliminato con successo.'); window.location.href='index.php?page=admin_ranking';</script>";
    } else {
        echo "<script>alert('Errore nell'eliminazione del Ranking.')</script>";
    }
}
?>

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-2">
    <div class="container">
        <h1>Admin - Gestione Ranking</h1>
        <!-- Ranking List-->
        <div class="row">
            <div class="col-md-12">
                <h2>Lista Classifiche</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titolo</th>
                            <th>descrizione</th>
                            <th>E' anche per gli inattivi?</th>
                            <th>status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rankings as $ranking): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($ranking->name); ?></td>
                                <td><?php echo htmlspecialchars($ranking->description); ?></td>
                                <?php if($ranking->includeInactive) : ?>
                                    <td class="">si</td>
                                <?php else : ?>
                                    <td class="">no</td>
                                <?php endif; ?>
                                <?php if($ranking->status === 1) : ?>
                                    <td class="bg-success">Attivo</td>
                                <?php else : ?>
                                    <td class="bg-secondary">Inattivo</td>
                                <?php endif; ?>
                                <td>
                                    <a href="index.php?page=admin_edit_ranking&id_ranking=<?php echo $ranking->id; ?>">Modifica</a>
                                </td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_ranking" value="<?php echo $ranking->id; ?>">
                                        <button class="btn btn-secondary" type="submit" name="delete" onclick="return confirm('Sei sicuro di voler eliminare questo Ranking?');">Elimina</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Add Ranking-->
        <div class="row">
    <div class="col-md-12">
        <h2>Aggiungi Classifiche</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="ranking_name">Nome della Classifica:</label>
                <input type="text" class="form-control" id="ranking_name" name="ranking_name" required>
            </div>
            <div class="form-group">
                <label for="description">Descrizione:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="rankingType">Tipo di classifica:</label>
                <select class="form-control" id="rankingType" name="rankingType">
                    <option value="wrestler">wrestler</option>
                    <option value="tag team">tag team</option>
                    <option value="federation">federazione</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                    <option value="1">Attivo</option>
                    <option value="0">Inattivo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Categoria:</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="">Nessuna Categoria</option>
                    <?php
                        foreach ($categories as $category) {
                            echo "<option value='" . htmlspecialchars($category['category_id']) . "'>" . htmlspecialchars($category['name']) . "</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Includere wrestler inattivi:</label>
                <div>
                    <input type="radio" id="include_inactive_yes" name="include_inactive" value="1" <?php echo (isset($_POST['include_inactive']) && $_POST['include_inactive'] == '1') ? 'checked' : ''; ?>>
                    <label for="include_inactive_yes">Sì</label>
                </div>
                <div>
                    <input type="radio" id="include_inactive_no" name="include_inactive" value="0" <?php echo (!isset($_POST['include_inactive']) || $_POST['include_inactive'] == '0') ? 'checked' : ''; ?>>
                    <label for="include_inactive_no">No</label>
                </div>
            </div>

            <button type="submit" name="add_ranking" class="btn btn-primary">Aggiungi Classifica</button>
        </form>
    </div>
</div>

    </div>
</div>
