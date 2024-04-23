<!-- resources/Views/admin/admin_users.php -->

<?php
$users = $userController->getAllUsers();


?>

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-2">
    <div class="container">
        <h1>Admin - Gestione User</h1>
        <div class="row">
            <div class="col-md-12">
                <h2>Lista Utenti</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Immagine</th>
                            <th>Ruolo</th>
                            <th>Iscritto il</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td>
                                    <img src="<?php echo ROOT; ?>/assets/img/users/<?php echo htmlspecialchars($user['image_path']); ?>" alt="Immagine utente" style="height: 50px; width: auto;">
                                </td>
                                <td><?php echo htmlspecialchars($user['role']); ?></td>
                                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                                <td>
                                    <a href="index.php?page=admin_detail_user&id_user=<?php echo $user['id_user']; ?>">Guarda dettagli</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
