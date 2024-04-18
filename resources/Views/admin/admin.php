<?php
    $rankingsWithScores = $rankingController->getRankingsWithTotalScores();
    $totalUsers = count($userController->getAllUsers());
    $federationsWrestlersCount = $federationController->getWrestlersCountPerFederation();
?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="row">
                <h1 class="d-flex justify-content-center text-uppercase mt-2">Admin Dashboard</h1>
            </div>
            
            <h4>Federazioni con più atleti</h4>
            <div>
                <ul>
                    <?php foreach ($federationsWrestlersCount as $federation): ?>
                        <li><?php echo htmlspecialchars($federation['name']) . " - Lottatori: " . htmlspecialchars($federation['total_wrestlers']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Top Ranking -->
            <h4>Top Classifiche</h4>
            <div>
                <ul>
                    <?php foreach ($rankingsWithScores as $ranking): ?>
                        <!-- Aggiornato per mostrare il conteggio totale dei voti invece del punteggio medio -->
                        <li><?php echo htmlspecialchars($ranking['ranking_name']) . " - Voti Totali: " . htmlspecialchars($ranking['total_votes']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Total users -->
            <h4>Total users</h4>
            <div id="totalUsers">
                <div class="alert alert-info" role="alert">
                    Total number of users signed: <strong><?php echo $totalUsers; ?></strong>
                </div>
            </div>
        </main>
    </div>
</div>

