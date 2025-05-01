<?php
$id = (int)$_GET['id'];

// Валидация данных
$errors = [];
$title = trim($_POST['title'] ?? '');
$category = (int)($_POST['category'] ?? 0);
$ingredients = trim($_POST['ingredients'] ?? '');
$description = trim($_POST['description'] ?? '');
$tags = trim($_POST['tags'] ?? '');
$steps = trim($_POST['steps'] ?? '');

if (empty($title)) {
    $errors[] = 'Название рецепта обязательно';
}
if (empty($category)) {
    $errors[] = 'Категория обязательна';
}
if (empty($ingredients)) {
    $errors[] = 'Ингредиенты обязательны';
}
if (empty($steps)) {
    $errors[] = 'Шаги приготовления обязательны';
}

if (!empty($errors)) {
    $recipe = getRecipeById($id);
    $categories = getAllCategories();
    render('recipe/edit', [
        'recipe' => $recipe,
        'categories' => $categories,
        'errors' => $errors
    ]);
    exit;
}

// Обновление в БД
$pdo = connectDB();
$stmt = $pdo->prepare("
    UPDATE recipes 
    SET title = ?, category = ?, ingredients = ?, description = ?, tags = ?, steps = ?
    WHERE id = ?
");
$stmt->execute([$title, $category, $ingredients, $description, $tags, $steps, $id]);

header("Location: ?route=recipe/show&id={$id}");
exit;