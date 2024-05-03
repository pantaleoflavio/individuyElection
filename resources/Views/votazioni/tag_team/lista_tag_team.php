<!-- resources/Views/votazioni/single_wrestler/lista_tag_team.php -->
<?php
    
    $id_cat = isset($_GET['id_cat']) ? $_GET['id_cat'] : null;
    
    if (isset($_GET['id_ranking'])) {
        $rankingIsActive = $rankingController->getRankingPerId($_GET['id_ranking'])->status;
        $rankingDetails = $rankingController->getRankingPerId($_GET['id_ranking']);
        $includeInactive = $rankingDetails ? $rankingDetails->includeInactive : false;

        
        if ($rankingIsActive === 0) {
            echo "<script>alert('Votazioni chiuse!'); window.location.href='index.php';</script>";
        }
    }
    
    if ($id_cat == '') {
        if (isset($_GET['id_ranking'])) {
            $listTagTeams = $tagTeamController->getAllTagTeams($includeInactive);
        } else {
            $listTagTeams = $tagTeamController->getAllTagTeams();
        }
        
    } else {
        $listTagTeams = $tagTeamController->getAllTagTeamsPerCategory($id_cat);
    }

?>

<main class="container">
    <div class="container py-5">
        <h2 class="text-center mb-4">Lista dei Tag Team</h2>
        <p>Scegli chi votare</p>
    
        <table id="candidatesTable" class="table">
            <thead>
                <tr>
                    <th onclick="sortTable(0, this)">Nome <i class="fa-solid" id="icon-name"></i></th>
                    <th onclick="sortTable(1, this)">Paese <i class="fa-solid" id="icon-country"></i></th>
                    <th onclick="sortTable(2, this)">Federazione <i class="fa-solid" id="icon-federation"></i></th>
                    <th class="">Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listTagTeams as $candidate): ?>
                    
                    <tr>
                        <td><?php echo $candidate['name'] ?? 'Nome non disponibile'; ?></td>
                        <td><?php echo $candidate['country'] ?? 'Paese non disponibile'; ?></td>
                        <td>
                            <?php
                                $federation = $federationController->getFederationPerId($candidate['federation_id']);
                                echo ($federation ? $federation->name : 'Federazione non disponibile');
                            ?>
                        </td>
                        <?php if(isset($_GET['id_ranking'])): ?>
                            <td>
                                <a href="index.php?page=vota_tag_team&id_tag_team=<?php echo $candidate['id_tag_team']; ?>&id_ranking=<?php echo $_GET['id_ranking']; ?>" class="btn btn-primary">Vota</a>
                            </td>
                        <?php else : ?>
                            <td>
                                <a href="index.php?page=votazione_dettaglio_tag_team" class="btn btn-primary">Vai alle votazioni</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<script>
    function sortTable(column, thElement) {
        var table, rows, switching, i, x, y, shouldSwitch, dir = "asc", switchcount = 0;
        table = document.getElementById("candidatesTable");
        switching = true;

        // Rimuovi tutte le icone dalle intestazioni
        document.querySelectorAll('.fa-solid').forEach(icon => {
            icon.classList.remove('fa-arrow-up', 'fa-arrow-down');
        });

        // Esegui un loop finché non sono stati fatti scambi
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[column];
                y = rows[i + 1].getElementsByTagName("TD")[column];
                if (dir === "asc" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase() ||
                    dir === "desc" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount === 0 && dir === "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }

        // Aggiungi la freccia corretta all'icona dell'intestazione corrente
        var icon = thElement.querySelector('.fa-solid');
        if (dir === "asc") {
            icon.classList.add('fa-arrow-down');
        } else {
            icon.classList.add('fa-arrow-up');
        }
    }

</script>