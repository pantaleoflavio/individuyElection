<!-- resources/Views/votazioni/lista_candidati.php -->

<?php

    $listWrestlers;
    if ($_GET['id_cat'] === '') {
        $listWrestlers = $wrestlerController->getAllWrestlers();
    } else {
        $listWrestlers = $wrestlerController->getAllWrestlersPerCategory($_GET['id_cat']);
    }
    
    

?>

<div class="container py-5">
    <h2 class="text-center mb-4"></h2>
    <p>Scegli chi votare</p>
    <div class="list-group">
        <?php foreach($listWrestlers as $candidate): ?>
            <a href="index.php?page=vota_wrestler&id=<?php echo $candidate->id_wrestler; ?>" class="list-group-item list-group-item-action">
                <?php echo htmlspecialchars($candidate->name); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>