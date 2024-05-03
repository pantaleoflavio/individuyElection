<!-- resources/Views/admin/admin_edit_tag_team.php -->


<?php

$tagTeam = null;
$categoryList = $categoryController->getAllCategories();
$federationList = $federationController->getAllFederations();

if (isset($_GET['id_tag_team'])) {
    $tagTeam = $tagTeamController->getTagTeamPerId($_GET['id_tag_team']);
}

if (isset($_POST['updateTagTeam'])) {
    $id = $_GET['id_tag_team'];
    $name = $_POST['name'];
    $country = $_POST['country'];
    $categoryId = $_POST['category_id'] === '' ? NULL : $_POST['category_id'];
    $federationId = $_POST['federation_id'];
    $is_active = $_POST['is_active'];

    $updateResult = $tagTeamController->updateTagTeam($id, $name, $country, $categoryId, $federationId, $is_active);
    if ($updateResult) {
        echo "<script>alert('Tag Team aggiornato con successo!')</script>";
        echo "<script>window.location.href='http://" . $_SERVER['SERVER_NAME'] . "/individuyElection/index.php?page=admin_tag_team'</script>";
    } else {
        echo "<script>alert('Errore nell'aggiornamento del Tag Team.')</script>";
    }

}
?>
<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <h1>Edit Wrestler</h1>
        <?php if ($tagTeam): ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $tagTeam->id; ?>" />
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" value="<?php echo $tagTeam->name; ?>" required>
            </div>
            <div class="form-group">
                <label for="country">Paese:</label>
                <input type="text" name="country" id="country" value="<?php echo $tagTeam->country; ?>">
            </div>
            <div class="form-group">
                <label for="category_id">Categoria:</label>
                <select name="category_id" id="category_id">
                    <option value="">Seleziona Categoria</option>
                    <option value="" >Pesi Massimi</option>
                    <?php foreach ($categoryList as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>" <?php echo $category['category_id'] == $tagTeam->categoryId ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                        <div><?php var_dump($category); ?></div>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="federation_id">Federazione:</label>
                <select name="federation_id" id="federation_id">
                    <option value="">Seleziona Federazione</option>
                    <?php foreach ($federationList as $federation): ?>
                        <option value="<?php echo $federation['id_federation']; ?>" <?php echo $federation['id_federation'] == $tagTeam->federationId ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($federation['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="is_active">Attivita:</label>
                <select name="is_active" id="is_active">
                    <option value="1">In attivita</option>
                    <option value="0">Ritirato</option>
                </select>
            </div>
            <button type="submit" name="updateTagTeam" class="btn btn-primary">Update</button>
        </form>
        <?php else: ?>
            <p>Tag Team non trovato.</p>
        <?php endif; ?>
    </div>
</div>

