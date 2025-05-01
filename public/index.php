<?php
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/helpers.php';

// Маршрутизация
$route = $_GET['route'] ?? 'home';

switch ($route) {
    case 'home':
        $page = (int)($_GET['page'] ?? 1);
        $data = getRecipesWithPagination($page);
        render('index', $data);
        break;
    case 'recipe/show':
        $id = (int)$_GET['id'];
        $recipe = getRecipeById($id);
        render('recipe/show', ['recipe' => $recipe]);
        break;
    case 'recipe/create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require __DIR__ . '/../src/handlers/recipe/create.php';
        } else {
            $categories = getAllCategories();
            render('recipe/create', ['categories' => $categories]);
        }
        break;
    case 'recipe/edit':
        $id = (int)$_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require __DIR__ . '/../src/handlers/recipe/edit.php';
        } else {
            $recipe = getRecipeById($id);
            $categories = getAllCategories();
            render('recipe/edit', ['recipe' => $recipe, 'categories' => $categories]);
        }
        break;
    case 'recipe/delete':
        $id = (int)$_GET['id'];
        require __DIR__ . '/../src/handlers/recipe/delete.php';
        break;
    default:
        http_response_code(404);
        echo 'Страница не найдена';
        break;
}