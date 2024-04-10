<!-- resources/Views/classifiche/classifica.php -->

<?php
// Ottieni il parametro della classifica dalla query string
$classifica = $_GET['classifica'] ?? '';

// Qui dovresti implementare la logica per recuperare i dati della classifica specificata dal database
// Ad esempio, assumendo di avere una funzione getRanking($classifica) che ritorna i dati necessari

// Placeholder: dati fittizi della classifica
$rankingsData = [
    ['name' => 'John Cena', 'score' => 9.8],
    ['name' => 'The Undertaker', 'score' => 9.7],
    ['name' => 'Hulk Hogan', 'score' => 9.5],
    // Aggiungi altri dati di esempio o implementa il recupero dal database
];

// Titolo della classifica per esempio
$title = "Classifica: " . htmlspecialchars($classifica);
?>

<div class="container py-5">
    <h1 class="text-center mb-4"><?= $title ?></h1>
    <ul class="list-group">
        <?php foreach ($rankingsData as $ranking): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="index.php?page=vota_wrestler&nome=<?= htmlspecialchars($ranking['name']) ?>"><?= htmlspecialchars($ranking['name']) ?></a>
                <span class="badge bg-primary rounded-pill"><?= htmlspecialchars($ranking['score']) ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
