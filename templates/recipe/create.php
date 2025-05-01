<h1>Добавить новый рецепт</h1>

<form method="POST" action="?route=recipe/create">
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    
    <div class="mb-3">
        <label for="category" class="form-label">Категория</label>
        <select class="form-select" id="category" name="category" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label for="ingredients" class="form-label">Ингредиенты</label>
        <textarea class="form-control" id="ingredients" name="ingredients" rows="3" required></textarea>
    </div>
    
    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    
    <div class="mb-3">
        <label for="tags" class="form-label">Теги (через запятую)</label>
        <input type="text" class="form-control" id="tags" name="tags">
    </div>
    
    <div class="mb-3">
        <label for="steps" class="form-label">Шаги приготовления</label>
        <textarea class="form-control" id="steps" name="steps" rows="5" required></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="?route=home" class="btn btn-secondary">Отмена</a>
</form>