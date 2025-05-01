<h1><?= htmlspecialchars($recipe['title']) ?></h1>
<p><strong>Категория:</strong> <?= htmlspecialchars($recipe['category_name']) ?></p>
<p><strong>Ингредиенты:</strong></p>
<p><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>
<p><strong>Описание:</strong></p>
<p><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>
<p><strong>Шаги приготовления:</strong></p>
<p><?= nl2br(htmlspecialchars($recipe['steps'])) ?></p>
<p><strong>Теги:</strong> <?= htmlspecialchars($recipe['tags']) ?></p>

<div class="mt-4">
    <a href="?route=recipe/edit&id=<?= $recipe['id'] ?>" class="btn btn-warning">Редактировать</a>
    <a href="?route=recipe/delete&id=<?= $recipe['id'] ?>" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</a>
    <a href="?route=home" class="btn btn-secondary">Назад</a>
</div>