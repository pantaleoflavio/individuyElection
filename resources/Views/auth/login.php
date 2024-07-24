<!-- resources/Views/auth/login.php -->

<?php
use App\Controllers\SigninController;

if (isset($_SESSION['userId'])){
    echo "<script>window.location.href='" . ROOT . "/index.php?page=home'</script>";
} else {
    if (isset($_POST['login'])) {

        $input_email = $_POST['signinEmail'];
        $input_password = $_POST['signinPassword'];



        $signin = new SigninController($input_email, $input_password);

        try {
            //Running error handlers and user signup
            $signin->loginUser();
            // Going to back to front page
            echo "<script>alert('You are logged')</script>";
            echo "<script>window.location.href='" . ROOT . "/index.php?page=home'</script>";
        
        } catch (Exception $e) {
            // Mostra un messaggio di errore più dettagliato
            echo "<script>alert('Error: " . $e->getMessage() . "')</script>";
            // Logga l'errore per un'analisi più dettagliata
            error_log($e->getMessage());
        }

    }
}
?>
<main class="container">
    <div class="container py-5">
        <h2 class="text-center mb-4">Login</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Indirizzo Email</label>
                <input type="email" class="form-control" id="email" name="signinEmail" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="signinPassword" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Accedi</button>
        </form>
        <div class="mt-3">
            <a href="index.php?page=password_recovery">Hai dimenticato la password?</a>
        </div>
    </div>
</main>