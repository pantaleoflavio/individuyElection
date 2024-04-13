<!-- resources/Views/votazioni/votazione_dettaglio_wrestler.php -->

<?php
$rankingSIngleWrestler = $rankingController->getRankingPerCategory('wrestler');

?>

<div class="row my-5">
    <?php foreach($rankingSIngleWrestler as $ranking) : ?>
        <div class="col-md-6 mb-4">
            <a href="index.php?page=lista_candidati&id_ranking=<?php echo $ranking->id_ranking; ?>&id_cat=<?php echo $ranking->category_id; ?>">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h2> <?php echo $ranking->category_name; ?></h2>
                        <p> <?php echo $ranking->description; ?></p>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
    </div>
</div>

