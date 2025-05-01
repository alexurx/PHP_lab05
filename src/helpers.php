<?php
/**
 * Рендерит шаблон с переданными данными
 * 
 * @param string $view Название шаблона
 * @param array $data Данные для передачи в шаблон
 */
function render(string $view, array $data = []): void
{
    extract($data);
    require __DIR__ . "/../templates/layout.php";
}

/**
 * Получает все рецепты из базы данных
 * 
 * @return array Массив рецептов
 */
function getAllRecipes(): array
{
    $pdo = connectDB();
    $stmt = $pdo->query("SELECT r.*, c.name as category_name FROM recipes r JOIN categories c ON r.category = c.id");
    return $stmt->fetchAll();
}

/**
 * Получает рецепт по ID
 * 
 * @param int $id ID рецепта
 * @return array|false Данные рецепта или false, если не найден
 */
function getRecipeById(int $id)
{
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT r.*, c.name as category_name FROM recipes r JOIN categories c ON r.category = c.id WHERE r.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

/**
 * Получает все категории
 * 
 * @return array Массив категорий
 */
function getAllCategories(): array
{
    $pdo = connectDB();
    $stmt = $pdo->query("SELECT * FROM categories");
    return $stmt->fetchAll();
}

/**
 * Получает рецепты с пагинацией
 * 
 * @param int $page Номер страницы
 * @param int $perPage Количество рецептов на странице
 * @return array Массив с рецептами и информацией о пагинации
 */
function getRecipesWithPagination(int $page = 1, int $perPage = 5): array
{
    $pdo = connectDB();
    $offset = ($page - 1) * $perPage;
    
    // Получаем рецепты для текущей страницы
    $stmt = $pdo->prepare("
        SELECT r.*, c.name as category_name 
        FROM recipes r 
        JOIN categories c ON r.category = c.id
        LIMIT ? OFFSET ?
    ");
    $stmt->execute([$perPage, $offset]);
    $recipes = $stmt->fetchAll();
    
    // Получаем общее количество рецептов
    $total = $pdo->query("SELECT COUNT(*) FROM recipes")->fetchColumn();
    $totalPages = ceil($total / $perPage);
    
    return [
        'recipes' => $recipes,
        'currentPage' => $page,
        'totalPages' => $totalPages,
    ];
}