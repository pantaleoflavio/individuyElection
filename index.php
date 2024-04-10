<?php
// index.php nella directory radice

// Definisci la costante per la root del sito
define('ROOT', "http://" . $_SERVER['SERVER_NAME'] . "/individuyElection");

// Avvia la sessione, gestisci le dipendenze, ecc.
session_start();

require __DIR__ . '/vendor/autoload.php';


$page = $_GET['page'] ?? 'home';

// Include l'header
include_once "includes/header.php";

// Contenuto principale
echo '<main class="container">';

// TODO valuta altri modi di gestione entry point:
// include 'resources/Views/' . $page . '.php';

switch ($page) {
    case 'home':
        include 'resources/Views/home.php';
        break;
    case 'votazioni':
        include 'resources/Views/votazioni/list.php';
        break;
    case 'votazione_dettaglio':
        // Assicurati di avere un modo per identificare quale votazione dettagliata mostrare
        $votazione = $_GET['votazione'] ?? null;
        if ($votazione === 'woty2024') {
            include 'resources/Views/votazioni/woty2024.php';
        } else {
            // Potresti includere qui un file di default o mostrare un errore
        }
        break;
    case 'vota_wrestler':
        include 'resources/Views/votazioni/vota_wrestler.php';
        break;
    case 'indice_classifiche':
        include 'resources/Views/classifiche/indice_classifiche.php';
        break;
    case 'classifica':
        // Assicurati che il file classifica.php sia incluso correttamente
        include 'resources/Views/classifiche/classifica.php';
        break;
    case 'user':
        include 'resources/Views/user/user.php';
        break;
    case 'cronologia_voti':
        include 'resources/Views/user/cronology_votes.php';
        break;
    case 'login':
        include 'resources/Views/auth/login.php';
        break;
    case 'signup':
        include 'resources/Views/auth/signup.php';
        break;
    case 'logout':
        include 'resources/Views/auth/logout.php';
        break;
    // ...altri casi...
    default:
        include 'resources/Views/error/404.php';
        break;
}

echo '</main>';

// Include il footer
include_once "includes/footer.php";
?>
