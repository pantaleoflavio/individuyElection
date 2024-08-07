<!-- resources/Views/votazioni/single_wrestler/vota_tag_team.php -->

<?php
// Placeholder per la logica del controller
if (!$_GET['id_tag_team'] || !$_SESSION['userId']) {
    echo "<script>alert('Effettua il login prima di votare')</script>";
    echo "<script>window.location.href='" . ROOT . "/index.php?page=home'</script>";
} else {

    $tagTeamId = $_GET['id_tag_team'] ?? null;
    $rankingId = $_GET['id_ranking'];
    $tagTeamDetails = $tagTeamController->getTagTeamPerId($tagTeamId);
    $alreadyVoted = $voteController->hasUserAlreadyVoted($_SESSION['userId'], $rankingId, $wrestlerId=null, $tagTeamId, $federationId=null);
    
    if (!$tagTeamDetails) {
        echo "<script>window.location.href='" . ROOT . "/index.php?page=404'</script>";
    }


    if ($alreadyVoted) {
        echo "<script>alert('Hai già dato il tuo voto qua.')</script>";
        echo "<script>window.location.href='" . ROOT . "/index.php?page=lists'</script>";
        exit();
    }


}

?>

<main class="container">
    <div class="container py-5">
        <h2 class="text-center mb-4">Vota per: <?= htmlspecialchars($tagTeamDetails->name); ?></h2>
    
        <!-- Dettagli del Wrestler -->
        <div class="wrestler-details mb-4">
            <!-- Aggiungi qui i dettagli del wrestler -->
            <p><strong>Nome:</strong> <?= htmlspecialchars($tagTeamDetails->name); ?></p>
            <p><strong>nazione:</strong> <?= htmlspecialchars($tagTeamDetails->country); ?></p>
            <?php if($tagTeamDetails->categoryId != '') : ?>
                <?php 
                    $categoryName = $categoryController->getSingleCategory($tagTeamDetails->categoryId)->categoryName;
                ?>
                <p><strong>stile:</strong> <?= htmlspecialchars($categoryName); ?></p>
            <?php endif; ?>
            <?php if($tagTeamDetails->federationId != '') : ?>
                <?php 
                    $federation = $federationController->getFederationPerId($tagTeamDetails->federationId); 
                ?>
                <p><strong>Federazione:</strong> <?= htmlspecialchars($federation->name);?> </p>
            <?php else : ?>
                <p><strong>Federazione non disponibile</strong></p>
            <?php endif; ?>
            <!-- Aggiungi altri dettagli come necessario -->
        </div>
    
        <!-- Form di Votazione -->
        <form action="<?php echo ROOT; ?>/resources/Views/votazioni/submit_vote.php" method="post">
            <input type="hidden" name="id_tag_team" value="<?php echo $tagTeamId; ?>">
            <input type="hidden" name="id_ranking" value="<?php echo $rankingId; ?>">
            <input type="hidden" name="id_user" value="<?php echo $_SESSION['userId']; ?>">
            <input type="hidden" name="year" value="<?= date('Y'); ?>">
    
            <p>Valuta da 0 a 10 (incrementi di 0.5):</p>
            
            <?php for ($i = 0; $i <= 20; $i++): ?>
                <?php $value = $i / 2; ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rating" id="rating-<?= $value ?>" value="<?= $value ?>" <?= $i === 20 ? 'checked' : '' ?>>
                    <label class="form-check-label" for="rating-<?= $value ?>"><?= $value ?></label>
                </div>
            <?php endfor; ?>
    
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Invia il tuo voto</button>
            </div>
        </form>
    </div>
</main>
