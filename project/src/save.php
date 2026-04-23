<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function getPostData(): array
{
    return [
        "title" => trim($_POST['title'] ?? ''),
        "ingredients" => trim($_POST['ingredients'] ?? ''),
        "instructions" => trim($_POST['instructions'] ?? ''),
        "category" => trim($_POST['category'] ?? ''),
        "prep_time" => trim($_POST['prep_time'] ?? ''),
        "difficulty" => trim($_POST['difficulty'] ?? ''),
        "created_at" => trim($_POST['created_at'] ?? ''),
        "author" => trim($_POST['author'] ?? '')
    ];
}

function validateData(array $data): ?string
{
    if ($data['title'] === '' || $data['ingredients'] === '' || $data['instructions'] === '') {
        return "Ошибка: заполните обязательные поля.";
    }

    if ($data['created_at'] === '' || !strtotime($data['created_at'])) {
        return "Ошибка: неверная дата.";
    }

    return null;
}

function saveToFile(array $data, string $file): void
{
    $existingData = file_exists($file)
        ? (json_decode(file_get_contents($file), true) ?? [])
        : [];

    $existingData[] = $data;

    file_put_contents($file, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Метод не POST');
}

$data = getPostData();
$error = validateData($data);

if ($error !== null) {
    exit($error);
}

// ВАЖНО: data.txt лежит в project/, save.php в project/src/
$file = __DIR__ . '/../data.txt';
saveToFile($data, $file);

echo "Рецепт сохранён! <a href='/index.php'>Назад</a>";