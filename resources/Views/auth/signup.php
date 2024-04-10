<!-- resources/Views/auth/signup.php -->
<?php

use App\Controllers\SignupController;

if (isset($_SESSION['userId'])){
    echo "<script>window.location.href='http://" . $_SERVER['SERVER_NAME'] . "/individuyElection/index.php?page=home'</script>";
} else {

    include __DIR__ . "/../../../app/Controllers/SignupController.php";

    if (isset($_POST['signup'])) {
      
        // saving input parameters in variables
        $user_fullname = $_POST['signUpName'];
        $user_email = $_POST['signUpEmail'];
        $username = $_POST['signUpUsername'];
        $user_image = 'user.jpg';
        $user_password = $_POST['signUpPassword'];
        $confirm_password = $_POST['confirmPassword'];


        //Instantiate SignupContr Class
        $signup = new SignupController($user_fullname, $user_email, $username, $user_image, $user_password, $confirm_password);

        try {
            $signup->signupUser();
            echo "<script>alert('Register successfully')</script>";
            echo "<script>window.location.href='http://" . $_SERVER['SERVER_NAME'] . "/individuyElection/index.php?page=login'</script>";

        } catch (Exception $e) {
            // Mostra un messaggio di errore più dettagliato
            echo "<script>alert('Error: " . $e->getMessage() . "')</script>";
            // Logga l'errore per un'analisi più dettagliata
            error_log($e->getMessage());
        }



    }
}
?>

<div class="container py-5">
    <h2 class="text-center mb-4">Registrazione</h2>
    <form action="" method="post">
    <div class="form-group">
                    <label for="signUpName">Your full name</label>
                    <input type="text" class="form-control" name="signUpName" id="signUpName" required>
                </div>
                <div class="form-group">
                    <label for="signUpEmail">Your email</label>
                    <input type="email" class="form-control" name="signUpEmail" id="signUpEmail" required>
                </div>
                <div class="form-group">
                    <label for="signUpUsername">Your username</label>
                    <input type="text" class="form-control" name="signUpUsername" id="signUpUsername" required>
                </div>
                <div class="form-group">
                    <label for="signUpPassword">Password</label>
                    <input type="password" class="form-control" name="signUpPassword" id="signUpPassword" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required>
                </div>
        <button type="submit" name="signup" class="btn btn-primary">Registrati</button>
    </form>
</div>
