<?php
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
    $categories = getAllCategories();
    render('recipe/create', [
        'categories' => $categories,
        'errors' => $errors,
        'formData' => $_POST
    ]);
    exit;
}

// Сохранение в БД
$pdo = connectDB();
$stmt = $pdo->prepare("
    INSERT INTO recipes (title, category, ingredients, description, tags, steps)
    VALUES (?, ?, ?, ?, ?, ?)
");
$stmt->execute([$title, $category, $ingredients, $description, $tags, $steps]);

header("Location: ?route=home");
exit;