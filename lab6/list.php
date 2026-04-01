<?php

/**
 * Читает данные рецептов из файла.
 *
 * @param string $file Путь к файлу
 * @return array Массив рецептов
 */
function readData(string $file): array
{
    if (!file_exists($file)) {
        return [];
    }

    $json = file_get_contents($file);
    return json_decode($json, true) ?? [];
}

/**
 * Сортирует рецепты по указанному полю.
 *
 * @param array $data Массив рецептов
 * @param string $field Поле сортировки
 * @return array Отсортированный массив
 */
function sortData(array $data, string $field): array
{
    usort($data, function ($a, $b) use ($field) {
        return strcmp($a[$field], $b[$field]);
    });

    return $data;
}

/**
 * Обрабатывает GET-запрос и применяет сортировку.
 *
 * @param array $data Массив рецептов
 * @return array Обработанный массив
 */
function handleSorting(array $data): array
{
    if (isset($_GET['sort'])) {
        return sortData($data, $_GET['sort']);
    }

    return $data;
}

$file = 'data.txt';
$data = readData($file);
$data = handleSorting($data);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список рецептов</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        .table-container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        tr:hover {
            background: #ddd;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .sort {
            text-align: center;
            margin-bottom: 10px;
        }

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
</head>
<body>

<h2>Список рецептов</h2>

<div class="table-container">

    <div class="sort">
        Сортировать:
        <a href="?sort=title">По названию</a> |
        <a href="?sort=category">По категории</a> |
        <a href="?sort=created_at">По дате</a>
    </div>

    <table>
        <tr>
            <th>Название</th>
            <th>Категория</th>
            <th>Сложность</th>
            <th>Дата</th>
            <th>Автор</th>
            <th>Время (мин)</th>
        </tr>

        <?php if (!empty($data)): ?>
            <?php foreach ($data as $recipe): ?>
                <tr>
                    <td><?= htmlspecialchars($recipe['title']) ?></td>
                    <td><?= htmlspecialchars($recipe['category']) ?></td>
                    <td><?= htmlspecialchars($recipe['difficulty']) ?></td>
                    <td><?= htmlspecialchars($recipe['created_at']) ?></td>
                    <td><?= htmlspecialchars($recipe['author']) ?></td>
                    <td><?= htmlspecialchars($recipe['prep_time']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Нет данных</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

<div class="link">
    <a href="index.html">Главная страница</a>
</div>

</body>
</html>