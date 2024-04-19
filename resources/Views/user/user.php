<?php 
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $singleUser = $userController->getSingleUser($userId);
    $voteHistory = $voteController->getVoteHistoryByUserId($userId);
} else {
    echo "<script>window.location.href='http://" . $_SERVER['SERVER_NAME'] . "/individuyElection/index.php?page=home'</script>";
}
?>
<main class="container">
    <div class="row py-5 align-items-start"> 
        <div class="col-12 col-md-6 mb-4">
            <h1 class="text-center mb-4">Profilo Utente</h1>
            <div class="card h-100"> 
                <div class="profile-picture p-3">
                    <img src="<?php echo ROOT ?>/assets/img/users/<?php echo $singleUser->user_pic; ?>" class="img-fluid" alt="Immagine Profilo Utente">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($singleUser->fullname); ?></h5>
                    <p>Username: <?php echo htmlspecialchars($singleUser->username); ?></p>
                    <p>Email: <?php echo htmlspecialchars($singleUser->email); ?></p>
                    <a href="index.php?page=user-setting" class="btn btn-primary">Modifica Profilo</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <h1 class="text-center mb-4">Storico dei Voti</h1>
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
</main>
