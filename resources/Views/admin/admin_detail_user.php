<?php 
if (isset($_GET['id_user'])) {
    $userId = $_GET['id_user'];
    $singleUser = $userController->getSingleUser($userId);
    $voteHistory = $voteController->getVoteHistoryByUserId($userId);

    if (isset($_POST['set_role'])) {
        $role = $_POST['role'];
        $setRole = $userController->setUserRole($userId, $role);
        echo "<script>alert('ruolo cambiato.')</script>";
    }
} else {
    echo "<script>window.location.href='http://" . $_SERVER['SERVER_NAME'] . "/individuyElection/index.php?page=home'</script>";
}
?>
<div class="col-md-9 ms-sm-auto col-lg-10 px-md-2">
    <div class="container">
        <div class="col-md-12 mb-4">
            <h1 class="text-center mb-4">Profilo Utente</h1>
            <div class="card h-100"> 
                <div class="profile-picture p-3">
                    <img src="<?php echo ROOT ?>/assets/img/users/<?php echo $singleUser->user_pic; ?>" class="img-fluid" alt="Immagine Profilo Utente">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($singleUser->fullname); ?></h5>
                    <p>Username: <?php echo htmlspecialchars($singleUser->username); ?></p>
                    <p>ruolo: <?php echo htmlspecialchars($singleUser->role); ?></p>
                    <form action="" method="post">
                        <?php if ($singleUser->role === 'user') : ?>
                            <input type="hidden" id="role" name="role" value="admin">
                        <?php else : ?>
                            <input type="hidden" id="role" name="role" value="user">
                        <?php endif; ?>
                        <button name="set_role" class="btn btn-primary">Modifica ruolo</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <h3 class="text-center mb-4">Storico dei Voti</h3>
            <div class="card h-100">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <?php foreach ($voteHistory as $vote): ?>
                            <li>
                                <?php 
                                    // Pre-check per assicurarsi che il valore non sia null
                                    $rankingName = htmlspecialchars($vote['ranking_name'] ?? 'N/A');
                                    $wrestlerName = htmlspecialchars($vote['wrestler_name'] ?? 'N/A');
                                    $federationName = htmlspecialchars($vote['federation_name'] ?? 'N/A');
                                    $tagTeamName = htmlspecialchars($vote['tag_team_name'] ?? 'N/A');
                                    $score = htmlspecialchars($vote['score']);
                                    $createdAt = date("d/m/Y H:i", strtotime($vote['created_at']));

                                    echo "{$rankingName}: " .
                                         ($wrestlerName !== 'N/A' ? "{$wrestlerName} - " : "") .
                                         ($federationName !== 'N/A' ? "{$federationName} - " : "") .
                                         ($tagTeamName !== 'N/A' ? "{$tagTeamName} - " : "- ") .
                                         "Score: {$score} ({$createdAt})";
                                ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
