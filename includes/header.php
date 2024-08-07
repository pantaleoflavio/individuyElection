
<?php 
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $singleUser = $userController->getSingleUser($userId);
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="<?php echo ROOT; ?>/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo ROOT; ?>/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo ROOT; ?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo ROOT; ?>/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo ROOT; ?>/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo ROOT; ?>/node_modules/bootstrap/dist/css/dootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/public/css/styles.css">

    <title>Plattaforma di Votazione Wrestling di Individuy Italiani</title>
</head>
<body>

<header class="">
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?page=home">individuy Election</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php?page=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=lists">Votazioni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=indice_classifiche">Classifiche</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=federation_list">Federazioni</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= isset($_SESSION['fullname']) ? $singleUser->fullname : 'Utente' ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if(!isset($_SESSION['userId'])) : ?>
                            <li><a class="dropdown-item" href="index.php?page=login">Login</a></li>
                            <li><a class="dropdown-item" href="index.php?page=signup">Signup</a></li>
                        <?php else : ?>
                            <li><a class="dropdown-item" href="index.php?page=user">Profilo</a></li>
                            <?php if($_SESSION['role'] === 'admin') : ?>
                                <li><a class="dropdown-item" href="index.php?page=admin">Admin Dashboard</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?page=logout">Log out</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
            <form action="index.php?page=search" method="get">
                <input type="hidden" name="page" value="search">
                <input type="text" name="query" placeholder="Cerca nel sito..." required>
                <button type="submit">Cerca</button>
            </form>
            </div>
        </div>
    </nav>
</header>