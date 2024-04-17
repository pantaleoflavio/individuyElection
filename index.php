<?php
// index.php nella directory radice

// Definisci la costante per la root del sito
define('ROOT', "http://" . $_SERVER['SERVER_NAME'] . "/individuyElection");

// Avvia la sessione, gestisci le dipendenze, ecc.
session_start();

require __DIR__ . '/vendor/autoload.php';

//INIT OF CONTROLLERS
use App\Controllers\UserController;
use App\Controllers\RankingController;
use App\Controllers\WrestlerController;
use App\Controllers\CategoryController;
use App\Controllers\VoteController;
use App\Controllers\FederationController;

$userController = new UserController();
$rankingController = new RankingController();
$wrestlerController = new WrestlerController();
$categoryController = new CategoryController();
$voteController = new VoteController();
$federationController = new FederationController();

// Variable for route managing
$page = $_GET['page'] ?? 'home';

// MESSAGE AFTER VOTING
if (isset($_SESSION['flash'])) {
    echo "<script>alert('" . $_SESSION['flash'] . "')</script>";
    unset($_SESSION['flash']); // Rimuovi il messaggio dopo la visualizzazione
}

// Include l'header
include_once "includes/header.php";

// Contenuto principale
echo '<main class="container">';

// TODO valuta altri modi di gestione entry point:
// include 'resources/Views/' . $page . '.php';

switch ($page) {
    case 'home':
        include "resources/Views/" . $page . ".php";
        break;
    //CASI DI VOTO
    case 'lists':
        include "resources/Views/votazioni/" . $page . ".php";
        break;
    //CASI DI VOTO SINGLE WRESTLER
    case 'votazione_dettaglio_wrestler':
    case 'lista_candidati':
    case 'vota_wrestler':
    case 'lista_per_federazioni':
        include "resources/Views/votazioni/single_wrestler/" . $page . ".php";  
        break;
    //CASI DI VOTO TAG TEAM
    //CASI DI VOTO FEDERATION
    case 'federation_list':
        include "resources/Views/votazioni/federation/" . $page . ".php";
        break;
    //CASI DI VOTO SHOW
    //CASI DI cLASSIFICHE
    case 'indice_classifiche':
    case 'classifica':
        include "resources/Views/classifiche/" . $page . ".php";
        break;
    //CASI DI USER
    case 'user':
    case 'user-setting':
    case 'cronologia_voti':
        include "resources/Views/user/" . $page . ".php";
        break;
    //CASI DI AUTH
    case 'login':
    case 'signup':
    case 'logout':
        include "resources/Views/auth/" . $page . ".php";
        break;
    // ...altri casi...
    default:
        include "resources/Views/error/404.php";
        break;
}

echo '</main>';

// Include il footer
include_once "includes/footer.php";
?>
