<!-- resources/Views/auth/handle_password_recovery.php -->

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];
    $user = $userController->getUserByEmail($email);

    if ($user) {
        $token = bin2hex(random_bytes(16));
        $expiry = date('Y-m-d H:i:s', time() + 3600);  // Scadenza 1 ora dopo
        if ($userController->saveResetToken($email, $token, $expiry)) {
            $resetLink = ROOT . "/index.php?page=reset_password&token=" . urlencode($token) . "&email=" . urlencode($email);
 
            $sendMailer->sendPasswordResetEmail($email, $resetLink);
            echo "<script>alert('Controlla la tua email per il link di reset della password');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Errore durante il salvataggio del token');</script>";
        }
    } else {
        echo "<script>alert('Email non trovata');</script>";
    }
}
?>
