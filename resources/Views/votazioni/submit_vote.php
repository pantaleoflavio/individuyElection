<?php
session_start();
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\VoteController;

$voteController = new VoteController();

// Assumiamo che i dati vengano raccolti correttamente dal form
$idRanking = $_POST['id_ranking'] ?? null;
$idWrestler = $_POST['wrestler_id'] ?? null; // Assicurati di gestire i campi che potrebbero non essere presenti
$idTagTeam = $_POST['id_tag_team'] ?? null;
$idUser = $_POST['id_user'] ?? null;
$score = $_POST['rating'] ?? null;
$year = $_POST['year'] ?? date('Y'); // Utilizza l'anno corrente se non fornito

// Prepara l'array di dati per il voto
$voteData = [
    'idRanking' => $idRanking,
    'idWrestler' => $idWrestler,
    'idTagTeam' => $idTagTeam,
    'idUser' => $idUser,
    'score' => $score,
    'year' => $year
];

// Invoca il controller per salvare il voto
$response = $voteController->submitVote($voteData);

// Gestisci la risposta e crea un messaggio flash
if ($response == true) {
    $_SESSION['flash'] = "Grazie per il tuo voto!";
} else {
    $_SESSION['flash'] = "Errore: Il tuo voto non è stato registrato.";
}

if ($response == true) {
    echo "Voto salvato con successo.";
} else {
    echo "Errore nel salvataggio del voto";
}

// Reindirizza l'utente alla pagina da cui è venuto o a una pagina di default
echo "<script> window.location.href='/index.php?page=home'</script>";

exit();
