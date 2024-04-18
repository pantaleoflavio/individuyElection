<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="<?php echo ROOT; ?>/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo ROOT; ?>/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo ROOT; ?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo ROOT; ?>/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo ROOT; ?>/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo ROOT; ?>/node_modules/bootstrap/">

    <!-- Style -->
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/public/css/styles.css">
    
    <title>Dashboard Admin - Individuy Election App</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <button class="btn btn-primary d-block d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">Menu</span>
            </button>
            
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?page=home">
                                <i class="fas fa-home"></i> Main Site
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=admin">
                                <i class="fa-solid fa-hammer"></i> Admin Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="fa-solid fa-user"></i> lista Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="fa-solid fa-video"></i> Lista Wrestler
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="fa-solid fa-tv"></i> Lista Stili
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-ticket"></i> Lista Federation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-ticket"></i> Lista votazioni
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>