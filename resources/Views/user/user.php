<!-- resources/Views/user/user.php -->
<?php 
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $singleUser = $userController->getSingleUser($userId);
} else {
    echo "<script>window.location.href='http://" . $_SERVER['SERVER_NAME'] . "/individuyElection/index.php?page=home'</script>";
}

?>
<main class="container">
    <div class="container py-5">
        <h1 class="text-center mb-4">Profilo Utente</h1>
    
        <div class="card">
            <div class="profile-picture">
                <img src="<?php echo ROOT ?>/assets/img/users/<?php echo $singleUser->user_pic; ?>" class="img-fluid" alt="Immagine Profilo Utente">
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $singleUser->fullname; ?></h5>
                <p>Username: <?php echo $singleUser->username; ?></p>
                <p>Email: <?php echo $singleUser->email; ?></p>
                <!-- Link per modificare il profilo, visualizzare la cronologia delle votazioni, ecc. -->
                <a href="index.php?page=user-setting" class="btn btn-primary">Modifica Profilo</a>
                <a href="index.php?page=cronologia_voti" class="btn btn-secondary">Cronologia Votazioni</a>
            </div>
        </div>
    </div>
</main>