<!-- resources/Views/votazioni/single_wrestler/votazione_dettaglio_wrestler.php -->

<?php
$rankingSingleWrestler = $rankingController->getRankingPerCategory('wrestler');
?>
<main class="container">
    <div class="row my-5">
        <?php if (!empty($rankingSingleWrestler)): ?>
            <?php foreach($rankingSingleWrestler as $ranking) : ?>
                <div class="col-md-6 mb-4">
                    <a href="index.php?page=lista_candidati&id_ranking=<?php echo $ranking->id; ?>&id_cat=<?php echo $ranking->categoryId; ?>">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h2><?= htmlspecialchars($ranking->name); ?></h2>
                                <p><?= htmlspecialchars($ranking->description); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p>Nessun ranking trovato per la categoria specificata.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

