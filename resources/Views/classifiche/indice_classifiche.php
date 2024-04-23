<!-- resources/Views/classifiche/indice_classifiche.php -->

<?php
$rankingAvailable = $rankingController->getAllRanking();

?>
<main class="container">
    <div class="container py-5">
        <h1 class="text-center mb-4">Classifiche Disponibili</h1>
        <?php foreach($rankingAvailable as $ranking) : ?>
                <div class="list-group">
                    <a href="index.php?page=classifica&id_ranking=<?php echo $ranking->idRanking; ?>" class="list-group-item list-group-item-action">
                        <?php echo htmlspecialchars($ranking->rankingName); ?>
                        <!-- Aggiunta di un badge per lo stato del ranking -->
                        <span class="badge <?php echo $ranking->status == 1 ? 'bg-success' : 'bg-secondary'; ?>">
                            <?php echo $ranking->status == 1 ? 'Attivo' : 'Non Attivo'; ?>
                        </span>
                    </a>
                </div>
        <?php endforeach; ?>
    </div>
</main>