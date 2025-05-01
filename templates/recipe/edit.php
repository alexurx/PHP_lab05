<h1>Редактирование рецепта: <?= htmlspecialchars($recipe['title']) ?></h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" action="?route=recipe/edit&id=<?= $recipe['id'] ?>">
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" name="title" 
               value="<?= htmlspecialchars($recipe['title']) ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="category" class="form-label">Категория</label>
        <select class="form-select" id="category" name="category" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" 
                    <?= $category['id'] == $recipe['category'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label for="ingredients" class="form-label">Ингредиенты</label>
        <textarea class="form-control" id="ingredients" name="ingredients" 
                  rows="5" required><?= htmlspecialchars($recipe['ingredients']) ?></textarea>
    </div>
    
    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea class="form-control" id="description" name="description" 
                  rows="3" required><?= htmlspecialchars($recipe['description']) ?></textarea>
    </div>
    
    <div class="mb-3">
        <label for="tags" class="form-label">Теги (через запятую)</label>
        <input type="text" class="form-control" id="tags" name="tags"
               value="<?= htmlspecialchars($recipe['tags']) ?>">
    </div>
    
    <div class="mb-3">
        <label for="steps" class="form-label">Шаги приготовления</label>
        <textarea class="form-control" id="steps" name="steps" 
                  rows="8" required><?= htmlspecialchars($recipe['steps']) ?></textarea>
    </div>
    
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="?route=recipe/show&id=<?= $recipe['id'] ?>" class="btn btn-secondary">Отмена</a>
    </div>
</form>