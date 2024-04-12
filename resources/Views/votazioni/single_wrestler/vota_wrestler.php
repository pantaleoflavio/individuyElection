<!-- resources/Views/votazioni/vota_wrestler.php -->

<?php
// Placeholder per la logica del controller
if (!$_GET['id'] || !$_SESSION['userId']) {
    echo "<script>window.location.href='http://" . $_SERVER['SERVER_NAME'] . "/individuyElection/index.php?page=home'</script>";
} else {
    $wrestlerId = $_GET['id'] ?? null;
    $wrestlerDetails = $wrestlerController->getSingleWrestlerPerId($wrestlerId);

    if (!$wrestlerDetails) {
        echo "<script>window.location.href='http://" . $_SERVER['SERVER_NAME'] . "/individuyElection/index.php?page=404'</script>";
    } else {
        # code...
    }

}

?>

<div class="container py-5">
    <h2 class="text-center mb-4">Vota per: <?= htmlspecialchars($wrestlerDetails->name); ?></h2>

    <!-- Dettagli del Wrestler -->
    <div class="wrestler-details mb-4">
        <!-- Aggiungi qui i dettagli del wrestler -->
        <p><strong>Nome:</strong> <?= htmlspecialchars($wrestlerDetails->name); ?></p>
        <p><strong>altezza:</strong> <?= htmlspecialchars($wrestlerDetails->height); ?></p>
        <p><strong>peso:</strong> <?= htmlspecialchars($wrestlerDetails->weight); ?></p>
        <p><strong>continente:</strong> <?= htmlspecialchars($wrestlerDetails->continent); ?></p>
        <p><strong>nazione:</strong> <?= htmlspecialchars($wrestlerDetails->country); ?></p>
        <?php if($wrestlerDetails->categoryId != '') : ?>
            <?php 
                $categoryName = $categoryController->getSingleCategory($wrestlerDetails->categoryId)[0]['name'];
            ?>
            <p><strong>categoria:</strong> <?= htmlspecialchars($categoryName); ?></p>
        <?php endif; ?>
        <!-- Aggiungi altri dettagli come necessario -->
    </div>

    <!-- Form di Votazione -->
    <form action="path/to/submit_vote.php" method="post">
        <input type="hidden" name="wrestler_id" value="<?= htmlspecialchars($wrestlerId); ?>">

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
