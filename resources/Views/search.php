<?php

// Ottieni il termine di ricerca dall'input dell'utente
$query = $_GET['query'] ?? '';


// Esegui la ricerca se la query non è vuota
$results = !empty($query) ? $searchEngine->searchSite($query) : [];

?>
<main class="container">
    <div class="search-results">
        <h1>Risultati della Ricerca</h1>
        <?php if (!empty($results)): ?>
            <?php foreach ($results as $type => $items): ?>
                <ul>
                    <?php foreach ($items as $item): ?>
                        <li>
                            <?php
                            // Mostra il nome con un link appropriato
                            $name = htmlspecialchars($item['name']);
                            $description = !empty($item['description']) ? " - " . htmlspecialchars($item['description']) : '';
                            $id = htmlspecialchars($item['id']);
                            $href = "";
                            switch ($type) {
                                case 'rankings':
                                    $href = "index.php?page=classifica&id_ranking=$id";
                                    break;
                                case 'categories':
                                    $href = "index.php?page=lista_candidati&id_cat=$id";
                                    break;
                                case 'federations':
                                    $href = "index.php?page=lista_per_federazioni&id_federation=$id";
                                    break;
                            }
                            echo "<a href='$href'>$name</a>$description";
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nessun risultato trovato per "<?php echo htmlspecialchars($query); ?>"</p>
        <?php endif; ?>
    </div>
</main>
