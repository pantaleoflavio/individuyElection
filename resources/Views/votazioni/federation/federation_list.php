<!-- resources/Views/votazioni/federation/federation_list.php -->

<div class="container py-5">
    <h2 class="text-center mb-4">Lista delle Federazioni</h2>
    <ul class="list-group">
        <?php
        $federations = $federationController->getAllFederations();
        foreach ($federations as $federation): ?>
            <li class="list-group-item">
                <a href="index.php?page=lista_per_federazioni&id_federation=<?= $federation['id_federation']; ?>">
                    <?= htmlspecialchars($federation['name']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
