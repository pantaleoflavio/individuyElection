<!-- resources/Views/user/user.php -->

<div class="container py-5">
    <h1 class="text-center mb-4">Profilo Utente</h1>

    <div class="card">
        <div class="profile-picture">
            <img src="<?php echo ROOT ?>/assets/img/users/user.jpg" class="img-fluid" alt="Immagine Profilo Utente">
        </div>
        <div class="card-body">
            <h5 class="card-title">Nome Utente</h5>
            <p class="card-text">Qui possono andare ulteriori dettagli dell'utente come email, data di iscrizione, ecc.</p>
            <!-- Link per modificare il profilo, visualizzare la cronologia delle votazioni, ecc. -->
            <a href="#" class="btn btn-primary">Modifica Profilo</a>
            <a href="index.php?page=cronologia_voti" class="btn btn-secondary">Cronologia Votazioni</a>
        </div>
    </div>
</div>