<!-- resources/Views/votazioni/single_wrestler/lista_per_federazioni.php -->
<?php
    
    // Assumi che federation_id venga passato tramite GET
    $id_federation = isset($_GET['id_federation']) ? $_GET['id_federation'] : null;

    if ($id_federation) {
        $listWrestlers = $wrestlerController->getWrestlersByFederation($id_federation);
        $listTagTeams = $tagTeamController->getTagTeamsByFederation($id_federation);
        $federationName = $federationController->getFederationPerId($id_federation)->name;

 
    } else {
        // Redirect o messaggio di errore se non è specificato un ID di federazione
        echo "<script>alert('Nessuna federazione specificata!'); window.location.href='index.php';</script>";
    }
?>

<main class="container">
    <div class="container py-5">
        <h2 class="text-center mb-4">Atleti della Federazione <?php echo htmlspecialchars($federationName); ?></h2>
        <h3>Singoli</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Paese</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listWrestlers as $wrestler): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($wrestler['name']); ?></td>
                        <td><?php echo htmlspecialchars($wrestler['country']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <a href="index.php?page=votazione_dettaglio_wrestler" class="btn btn-primary">Lista Votazioni Single Wrestler</a>
        </div>
        <h3>Tag Team</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Paese</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listTagTeams as $tagTeam): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($tagTeam['name']); ?></td>
                        <td><?php echo htmlspecialchars($tagTeam['country']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <a href="index.php?page=votazione_dettaglio_tag_team" class="btn btn-primary">Lista Votazioni Tag</a>
        </div>
    </div>
</main>
