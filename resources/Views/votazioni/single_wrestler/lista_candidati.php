<!-- resources/Views/votazioni/lista_candidati.php -->
<?php
    
    $id_cat = isset($_GET['id_cat']) ? $_GET['id_cat'] : null;

    if ($id_cat == '') {
        $listWrestlers = $wrestlerController->getAllWrestlers();
    } else {
        $listWrestlers = $wrestlerController->getAllWrestlersPerCategory($id_cat);
    }
?>

<div class="container py-5">
    <h2 class="text-center mb-4">Lista dei Candidati</h2>
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
            <?php foreach($listWrestlers as $candidate): ?>
                
                <tr>
                    <td><?php echo $candidate['name'] ?? 'Nome non disponibile'; ?></td>
                    <td><?php echo $candidate['country'] ?? 'Paese non disponibile'; ?></td>
                    <td>
                        <?php
                            $federation = $federationController->getFederationPerId($candidate['federation_id']);
                            echo ($federation ? $federation->name : 'Federazione non disponibile');
                        ?>
                    </td>
                    <td>
                        <a href="index.php?page=vota_wrestler&id_wrestler=<?php echo $candidate['id_wrestler']; ?>&id_ranking=<?php echo $_GET['id_ranking']; ?>" class="btn btn-primary">Vota</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

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