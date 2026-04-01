<?php

/**
 * Получает данные из формы ($_POST).
 *
 * @return array Ассоциативный массив данных рецепта
 */
function getPostData(): array
{
    return [
        "title" => $_POST['title'] ?? '',
        "ingredients" => $_POST['ingredients'] ?? '',
        "instructions" => $_POST['instructions'] ?? '',
        "category" => $_POST['category'] ?? '',
        "prep_time" => $_POST['prep_time'] ?? '',
        "difficulty" => $_POST['difficulty'] ?? '',
        "created_at" => $_POST['created_at'] ?? '',
        "author" => $_POST['author'] ?? ''
    ];
}

/**
 * Проверяет корректность данных рецепта.
 *
 * @param array $data Данные рецепта
 * @return string|null Возвращает строку ошибки или null если всё корректно
 */
function validateData(array $data): ?string
{
    if (empty($data['title']) || empty($data['ingredients']) || empty($data['instructions'])) {
        return "Ошибка: заполните обязательные поля.";
    }

    if (!strtotime($data['created_at'])) {
        return "Ошибка: неверный формат даты.";
    }

    return null;
}

/**
 * Сохраняет рецепт в файл data.txt в формате JSON.
 *
 * @param array $data Данные рецепта
 * @param string $file Путь к файлу
 * @return void
 */
function saveToFile(array $data, string $file): void
{
    $existingData = [];

    if (file_exists($file)) {
        $existingData = json_decode(file_get_contents($file), true) ?? [];
    }

    $existingData[] = $data;

    file_put_contents(
        $file,
        json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}

/**
 * Главная функция обработки формы.
 *
 * @return void
 */
function handleRequest(): void
{
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        return;
    }

    $data = getPostData();

    $error = validateData($data);

    if ($error !== null) {
        echo $error;
        return;
    }

    saveToFile($data, 'data.txt');

    echo "Рецепт успешно сохранён!";
}

handleRequest();
?>
<style>
            .link {
            text-align: center;
            margin-top: 20px;
        }

        .link a {
            background: #2196F3;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .link a:hover {
            background: #1976D2;
        }
</style>

<div class="link">
    <a href="index.html">Главная страница</a>
</div>

<div class="link">
    <a href="list.php">Посмотреть все рецепты</a>
</div>