<h1>Все рецепты</h1>

<?php if (empty($recipes)): ?>
    <div class="alert alert-info">Рецептов пока нет</div>
<?php else: ?>
    <div class="row">
        <?php foreach ($recipes as $recipe): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($recipe['title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars(substr($recipe['description'], 0, 100)) ?>...</p>
                        <span class="badge bg-secondary"><?= htmlspecialchars($recipe['category_name']) ?></span>
                        <a href="?route=recipe/show&id=<?= $recipe['id'] ?>" class="btn btn-primary mt-2">Подробнее</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- После списка рецептов -->
<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php if ($currentPage > 1): ?>
            <li class="page-item"><a class="page-link" href="?route=home&page=<?= $currentPage - 1 ?>">Предыдущая</a></li>
        <?php endif; ?>
        
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                <a class="page-link" href="?route=home&page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
        
        <?php if ($currentPage < $totalPages): ?>
            <li class="page-item"><a class="page-link" href="?route=home&page=<?= $currentPage + 1 ?>">Следующая</a></li>
        <?php endif; ?>
    </ul>
</nav>