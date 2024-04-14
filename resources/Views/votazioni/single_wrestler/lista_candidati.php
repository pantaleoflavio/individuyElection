<!-- resources/Views/votazioni/lista_candidati.php -->
<?php
    
    $order = $_GET['order'] ?? 'name';  // Default to ordering by name
    $id_cat = isset($_GET['id_cat']) ? $_GET['id_cat'] : null;

    if ($id_cat == '') {
        $listWrestlers = $wrestlerController->getAllWrestlers();
    } else {
        $listWrestlers = $wrestlerController->getAllWrestlersPerCategory($id_cat);
    }
?>

<div class="container py-5">
    <h2 class="text-center mb-4">Lista dei Candidati</h2>
    <p>Scegli chi votare</p>
    <div class="mb-3">
        <select id="sortOrder" class="form-select" onchange="sortCandidates()">
            <option value="name" <?= $order === 'name' ? 'selected' : '' ?>>Ordina per Nome</option>
            <option value="country" <?= $order === 'country' ? 'selected' : '' ?>>Ordina per Paese</option>
            <option value="federation" <?= $order === 'federation' ? 'selected' : '' ?>>Ordina per Federazione</option>
        </select>
    </div>
    <div class="list-group" id="candidatesList">
        <?php foreach($listWrestlers as $candidate): ?>

            <a href="index.php?page=vota_wrestler&id_wrestler=<?php echo $candidate['id_wrestler']; ?>&id_ranking=<?php echo $_GET['id_ranking']; ?>" class="list-group-item list-group-item-action">
                <?php echo ($candidate['name'] ?? 'Nome non disponibile'); ?> - 
                <?php echo ($candidate['country'] ?? 'Paese non disponibile'); ?> - 
                <?php
                    $federation = $federationController->getFederationPerId($candidate['federation_id']);
                    echo ($federation ? $federation->name : 'Federazione non disponibile');
                ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function sortCandidates() {
        var order = document.getElementById('sortOrder').value;
        window.location.href = 'http://localhost/individuyElection/index.php?page=lista_candidati&id_cat=<?= urlencode($_GET['id_cat']) ?>&id_ranking=<?= urlencode($_GET['id_ranking']) ?>&order=' + order;
    }

</script>
