<!-- resources/Views/classifiche/classifica.php -->

<?php
if (isset($_GET['id_ranking'])) {
    $idRanking = $_GET['id_ranking'];
    $rankingData = $rankingController->getRankingPerId($idRanking);
}
?>

<div class="container py-5">
    <h1 class="text-center mb-4"><?= $rankingData->rankingName; ?></h1>
    <p><?= $rankingData->description; ?></p>
    <ul class="list-group">
        <?php //foreach (): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="index.php?page=vota_wrestler"></a>
                <span class="badge bg-primary rounded-pill"></span>
            </li>
        <?php //endforeach; ?>
    </ul>
</div>
