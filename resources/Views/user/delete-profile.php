<!-- resources/Views/user/user-setting.php -->

<?php

if (!isset($_SESSION['userId'])) {
    echo "<script>window.location.href='http://" . $_SERVER['SERVER_NAME'] . "/individuyElection/index.php?page=home'</script>";
} else {
    $userId = $_SESSION['userId'];
    
    if (isset($_POST['deleteUser'])) {

        $providedPassword = $_POST['password'];
    
        $confirmUser = $userController->verifyUserPassword($userId, $providedPassword);

        echo $confirmUser;

        if ($confirmUser) {

            $deleteUser = $userController-> deleteUser($userId);
            session_unset();
            session_destroy();
            echo "<script>alert('Profilo eliminato con successo')</script>";
            echo "<script>window.location.href='http://" . $_SERVER['SERVER_NAME'] . "/individuyElection/index.php?page=home</script>";
        } else {
            echo "<script>alert('QUalcosa non ha funzionato')</script>";
        }
    }

}



?>

<main class="container my-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-6">
                <h5 class="mb-3">Elimina Il Profilo</h5>
                <!-- Account Detail of the Page -->
                <form method="POST" class="">
                    <fieldset>
                        <div class="py-3">
                            <input name="password" class="form-control" placeholder="Inserisci la tua Password" type="password">
                        </div>
                        <div class="py-3 text-right">
                            <button type="submit" name="deleteUser" class="btn btn-primary">Elimina il profilo</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</main>
