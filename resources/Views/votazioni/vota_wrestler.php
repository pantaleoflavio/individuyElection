<!-- resources/Views/votazioni/vota_wrestler.php -->

<?php
// Assicurati di sanitizzare e validare questi dati in un'applicazione reale
$wrestlerName = $_GET['nome'] ?? 'Wrestler Sconosciuto';
?>

<div class="container py-5">
    <h2 class="text-center mb-4">Vota per: <?= htmlspecialchars($wrestlerName) ?></h2>
    <form action="" method="post">
        <input type="hidden" name="wrestler_name" value="<?= htmlspecialchars($wrestlerName) ?>">
        
        <p>Valuta il wrestler da 0 a 10 (incrementi di 0.5):</p>
        
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
