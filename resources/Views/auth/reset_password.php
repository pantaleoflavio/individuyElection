<!-- resources/Views/auth/reset_password.php -->
<?php

if (isset($_GET['email'], $_GET['token'])) {
    $oldToken = $_GET['token'];
    $email = $_GET['email'];
    $tokenVerify = $userController->verifyResetToken($email, $oldToken);

    if ($tokenVerify) {

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {

            $newPassword = $_POST['password'];
        
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $userController->updatePassword($email, $hashedPassword);
            echo "<script>alert('La tua password è stata reimpostata con successo!');</script>";
            echo "<script>window.location.href = 'index.php?page=login';</script>";
        }
    } else {
        echo "<script>alert('Reset password non valido o scaduto.');</script>";
        echo "<script>window.location = 'index.php';</script>";
        exit;
    }
}
?>

<main class="container">
    <div class="py-5">
        <h2 class="text-center mb-4">Imposta Nuova Password</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="password" class="form-label">Nuova Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="reset_password" class="btn btn-primary">Imposta Password</button>
        </form>
    </div>
</main>
