<?php

require_once __DIR__ . '/Database.php';

/**
 * Получить все записи (с названием категории)
 */
function getAllRecords(string $sort = 'id_desc'): array
{
    $pdo = Database::connect();

    $orderBy = match ($sort) {
        'title' => 'r.title ASC',
        'created_at' => 'r.created_at DESC',
        default => 'r.id DESC',
    };

    $stmt = $pdo->prepare("
        SELECT 
            r.*,
            c.name AS category
        FROM recipes r
        LEFT JOIN categories c ON c.id = r.category_id
        ORDER BY {$orderBy}
    ");
    $stmt->execute();

    return $stmt->fetchAll();
}

/**
 * Получить запись по ID
 */
function getRecordById(int $id): ?array
{
    $pdo = Database::connect();

    $stmt = $pdo->prepare("
        SELECT r.*, c.name AS category
        FROM recipes r
        LEFT JOIN categories c ON c.id = r.category_id
        WHERE r.id = ?
        LIMIT 1
    ");
    $stmt->execute([$id]);

    $row = $stmt->fetch();
    return $row ?: null;
}

/**
 * Создать запись
 */
function createRecord(array $data): void
{
    $pdo = Database::connect();

    $stmt = $pdo->prepare("
        INSERT INTO recipes 
        (title, ingredients, instructions, category_id, prep_time, difficulty, created_at, author)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $data['title'],
        $data['ingredients'],
        $data['instructions'],
        $data['category_id'],
        $data['prep_time'],
        $data['difficulty'],
        $data['created_at'],
        $data['author']
    ]);
}

/**
 * Обновить запись
 */
function updateRecord(int $id, array $data): void
{
    $pdo = Database::connect();

    $stmt = $pdo->prepare("
        UPDATE recipes SET 
            title = ?,
            ingredients = ?,
            instructions = ?,
            category_id = ?,
            prep_time = ?,
            difficulty = ?,
            created_at = ?,
            author = ?
        WHERE id = ?
    ");

    $stmt->execute([
        $data['title'],
        $data['ingredients'],
        $data['instructions'],
        $data['category_id'],
        $data['prep_time'],
        $data['difficulty'],
        $data['created_at'],
        $data['author'],
        $id
    ]);
}

/**
 * Удалить запись
 */
function deleteRecord(int $id): void
{
    $pdo = Database::connect();

    $stmt = $pdo->prepare("DELETE FROM recipes WHERE id = ?");
    $stmt->execute([$id]);
}

/**
 * Поиск (с JOIN категорий)
 */
function searchRecords(string $query, string $sort = 'id_desc'): array
{
    $pdo = Database::connect();

    $orderBy = match ($sort) {
        'title' => 'r.title ASC',
        'created_at' => 'r.created_at DESC',
        default => 'r.id DESC',
    };

    $stmt = $pdo->prepare("
        SELECT 
            r.*,
            c.name AS category
        FROM recipes r
        LEFT JOIN categories c ON c.id = r.category_id
        WHERE r.title LIKE ? OR r.ingredients LIKE ?
        ORDER BY {$orderBy}
    ");

    $search = "%{$query}%";
    $stmt->execute([$search, $search]);

    return $stmt->fetchAll();
}

/**
 * Валидация данных формы
 */
function validateRecipeData(array $data): ?string
{
    if ($data['title'] === '' || $data['ingredients'] === '' || $data['instructions'] === '') {
        return "Заполните обязательные поля";
    }
    return null;
}

/**
 * Нормализация данных из POST
 */
function getRecipePostData(): array
{
    $categoryRaw = trim((string)($_POST['category_id'] ?? ''));
    $categoryId = ($categoryRaw === '') ? null : (int)$categoryRaw;

    $prepRaw = trim((string)($_POST['prep_time'] ?? ''));
    $prepTime = ($prepRaw === '') ? null : (int)$prepRaw;

    return [
        "title" => trim((string)($_POST['title'] ?? '')),
        "ingredients" => trim((string)($_POST['ingredients'] ?? '')),
        "instructions" => trim((string)($_POST['instructions'] ?? '')),
        "category_id" => $categoryId,
        "prep_time" => $prepTime,
        "difficulty" => trim((string)($_POST['difficulty'] ?? '')),
        "created_at" => $_POST['created_at'] ?? date('Y-m-d'),
        "author" => trim((string)($_POST['author'] ?? '')),
    ];
}