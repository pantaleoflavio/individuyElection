<!-- resources/Views/classifiche/classifica.php -->

<?php
if (isset($_GET['id_ranking'])) {
    $idRanking = $_GET['id_ranking'];
    $rankingData = $rankingController->getRankingPerId($idRanking);
    $rankingScores = $rankingController->getRankingDetails($idRanking);
}
?>
<div class="container">
    <div class="container py-5">
        <h1 class="text-center mb-4"><?= htmlspecialchars($rankingData->rankingName); ?></h1>
        <p><?= htmlspecialchars($rankingData->description); ?></p>
        <ul class="list-group">
            <?php foreach ($rankingScores as $entry): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="index.php?page=vota_wrestler&id_wrestler=<?php echo $entry->id_wrestler; ?>&id_ranking=<?php echo $idRanking; ?>">
                        <?= htmlspecialchars($entry->name); ?>
                    </a>
                    <span class="badge bg-primary rounded-pill"><?= number_format($entry->averageScore, 1); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>