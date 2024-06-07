<!-- resources/Views/auth/password_recovery.php -->
<main class="container">
    <div class="py-5">
        <h2 class="text-center mb-4">Recupero Password</h2>
        <form action="index.php?page=handle_password_recovery" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Indirizzo Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" name="recover" class="btn btn-primary">Recupera Password</button>
        </form>
    </div>
</main>
