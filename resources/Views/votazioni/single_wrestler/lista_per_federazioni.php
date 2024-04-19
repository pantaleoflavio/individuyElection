<!-- resources/Views/votazioni/single_wrestler/lista_per_federazioni.php -->
<?php
    
    // Assumi che federation_id venga passato tramite GET
    $id_federation = isset($_GET['id_federation']) ? $_GET['id_federation'] : null;

    if ($id_federation) {
        $listWrestlers = $wrestlerController->getWrestlersByFederation($id_federation);
        $federationName = $federationController->getFederationPerId($id_federation)->name;
 
    } else {
        // Redirect o messaggio di errore se non è specificato un ID di federazione
        echo "<script>alert('Nessuna federazione specificata!'); window.location.href='index.php';</script>";
    }
?>

<div class="container">
    <div class="container py-5">
        <h2 class="text-center mb-4">Atleti della Federazione <?php echo htmlspecialchars($federationName); ?></h2>
        <table class="table">
            <thead>
                <tr>
                    <th><div class="row"><div class="col-md-4">Nome</div></div></th>
                    <th><div class="row"><div class="col-md-4">Paese</div></div></th>
                    <th><div class="row"><div class="col-md-4">Vai alle votazioni</div></div></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listWrestlers as $wrestler): ?>
                    <tr>
                        <td><div class="row"><div class="col-md-4"><?php echo htmlspecialchars($wrestler['name']); ?></div></div></td>
                        <td><div class="row"><div class="col-md-4"><?php echo htmlspecialchars($wrestler['country']); ?></div></div></td>
                        <td>
                            <div class="row"><div class="col-md-4">
                                <a href="index.php?page=votazione_dettaglio_wrestler" class="btn btn-primary">Lista Votazioni</a>
                            </div></div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
