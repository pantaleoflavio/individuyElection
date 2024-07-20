<?php
// index.php nella directory radice

// Definisci la costante per la root del sito
if (getenv('BASE_URL')) {
    //Se si usa docker
    define('ROOT', getenv('BASE_URL'));
} else {
    define('ROOT', "http://" . $_SERVER['SERVER_NAME'] . "/individuyElection");
}

// Avvia la sessione, gestisci le dipendenze, ecc.
session_start();

// Imposta il fuso orario
date_default_timezone_set('Europe/Rome');

require __DIR__ . '/vendor/autoload.php';

//INCLUDE OF CONTROLLERS
use App\Controllers\UserController;
use App\Controllers\RankingController;
use App\Controllers\WrestlerController;
use App\Controllers\TagTeamController;
use App\Controllers\CategoryController;
use App\Controllers\VoteController;
use App\Controllers\FederationController;
use App\Core\SendMailer;
//Search Engine
use App\Core\SearchEngine;
$searchEngine = new SearchEngine();

//INIT OF CONTROLLERS
$sendMailer = new SendMailer();
$userController = new UserController();
$rankingController = new RankingController();
$wrestlerController = new WrestlerController();
$tagTeamController = new TagTeamController();
$categoryController = new CategoryController();
$voteController = new VoteController();
$federationController = new FederationController();

// Variable for route managing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// MESSAGE AFTER VOTING
if (isset($_SESSION['flash'])) {
    echo "<script>alert('" . $_SESSION['flash'] . "')</script>";
    unset($_SESSION['flash']); // Rimuovi il messaggio dopo la visualizzazione
}

// TODO valuta altri modi di gestione entry point:
// include 'resources/Views/' . $page . '.php';

if (strpos($page, 'admin') === 0) {
    // Include l'header dell'amministratore se il valore di 'page' inizia con 'admin_'
    include_once "includes/admin_header.php";
} else {
    // Include l'header standard altrimenti
    include_once "includes/header.php";
}

// Contenuto principale

switch ($page) {
    case 'home':
        include "resources/Views/" . $page . ".php";
        break;
    //CASI DI SEARCH NEL SITO
    case 'search':
        include "resources/Views/search.php";
        break;
    //CASI DI VOTO
    case 'lists':
        include "resources/Views/votazioni/" . $page . ".php";
        break;
    //CASI DI VOTO SINGLE WRESTLER
    case 'votazione_dettaglio_wrestler':
    case 'lista_candidati':
    case 'vota_wrestler':
        include "resources/Views/votazioni/single_wrestler/" . $page . ".php";  
        break;
    //CASI DI VOTO TAG TEAM
    case 'votazione_dettaglio_tag_team':
    case 'lista_tag_team':
    case 'vota_tag_team':
        include "resources/Views/votazioni/tag_team/" . $page . ".php";  
        break;
    //CASI DI VOTO FEDERATION
    case 'federation_list':
    case 'lista_per_federazioni':
    case 'votazione_dettaglio_federation':
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
    case 'delete-profile':
        include "resources/Views/user/" . $page . ".php";
        break;
    //CASI DI AUTH
    case 'login':
    case 'signup':
    case 'logout':
    case 'password_recovery':
    case 'handle_password_recovery':
    case 'reset_password':
        include "resources/Views/auth/" . $page . ".php";
        break;
    //CASI DI Admin
    case 'admin':
    case 'admin_users':
    case 'admin_detail_user':
    case 'admin_wrestler':
    case 'admin_edit_wrestler':
    case 'admin_tag_team':
    case 'admin_edit_tag_team':
    case 'admin_category':
    case 'admin_edit_category':
    case 'admin_federation':
    case 'admin_edit_federation':
    case 'admin_ranking':
    case 'admin_edit_ranking':
        include "resources/Views/admin/" . $page . ".php";
        break;
    // ...altri casi...
    default:
        include "resources/Views/error/404.php";
        break;
}


// Include il footer
if (strpos($page, 'admin') === 0) {
    include_once "includes/admin_footer.php";
} else {
    include_once "includes/footer.php";
}
?>
