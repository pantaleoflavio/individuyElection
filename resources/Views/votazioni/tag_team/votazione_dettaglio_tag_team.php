<!-- resources/Views/votazioni/single_wrestler/votazione_dettaglio_tag_team.php -->

<?php
$rankingTagTeam = $rankingController->getRankingPerCategory('tag team');
?>
<main class="container">
    <div class="row my-5">
    <?php if (!empty($rankingTagTeam)): ?>
        <?php foreach($rankingTagTeam as $ranking) : ?>
            <div class="col-md-6 mb-4">
                <a href="index.php?page=lista_tag_team&id_ranking=<?php echo $ranking->id; ?>&id_cat=<?php echo $ranking->categoryId; ?>">
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
