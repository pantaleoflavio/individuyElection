<!-- resources/Views/votazioni/vota_wrestler.php -->

<?php

$wrestlerId = $_GET['id'] ?? 'Wrestler Sconosciuto';
$wrestlerDetails = $wrestlerController->getSingleWrestlerPerId($wrestlerId);
var_dump($wrestlerDetails);
?>

<div class="container py-5">
    <h2 class="text-center mb-4">Vota per: <?php echo $wrestlerDetails->name; ?></h2>
    <form action="" method="post">

        
        <p>Valuta da 0 a 10 (incrementi di 0.5):</p>
        
        <?php for ($i = 0; $i <= 20; $i++): ?>
            <div class="form-check form-check-inline">
                <?php $value = $i / 2; ?>
                <input class="form-check-input" type="radio" name="rating" id="rating-<?= $value ?>" value="<?= $value ?>" <?= $i === 20 ? 'checked' : '' ?>>
                <label class="form-check-label" for="rating-<?= $value ?>"><?= $value ?></label>
            </div>
        <?php endfor; ?>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Invia il tuo voto</button>
        </div>
    </form>
</div>
