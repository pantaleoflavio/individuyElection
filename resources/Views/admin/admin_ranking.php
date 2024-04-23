<!-- resources/Views/admin/admin_ranking.php -->

<?php
$rankings = $rankingController->getAllRanking();
$categories = $categoryController->getAllCategories();


if (isset($_POST['add_ranking'])) {
    $rankingName = $_POST['ranking_name'];
    $description = $_POST['description'];
    $rankingType = $_POST['rankingType'];
    $status = $_POST['status'];
    $categoryId = $_POST['category_id'];
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
                            <th>status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rankings as $ranking): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($ranking->rankingName); ?></td>
                                <td><?php echo htmlspecialchars($ranking->description); ?></td>
                                <?php if($ranking->status === 1) : ?>
                                    <td class="bg-success">Attivo</td>
                                <?php else : ?>
                                    <td class="bg-secondary">Inattivo</td>
                                <?php endif; ?>
                                <td>
                                    <a href="index.php?page=admin_edit_ranking&id_ranking=<?php echo $ranking->idRanking; ?>">Modifica</a>
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
        <form action="path_to_your_form_handling_script.php" method="post">
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
            <button type="submit" name="add_ranking" class="btn btn-primary">Aggiungi Classifica</button>
        </form>
    </div>
</div>

    </div>
</div>
