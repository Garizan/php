<?php

declare(strict_types=1);

/**
 * Массив транзакций.
 * Каждая транзакция представляет собой ассоциативный массив со следующими полями:
 * - id (int)            : уникальный идентификатор
 * - date (string)       : дата в формате YYYY-MM-DD
 * - amount (float)      : сумма транзакции
 * - description (string): описание транзакции
 * - merchant (string)   : получатель платежа
 *
 * @var array<int, array{
 *     id:int,
 *     date:string,
 *     amount:float,
 *     description:string,
 *     merchant:string
 * }>
 */
$transactions = [
    [
        "id" => 1,
        "date" => "2025-01-01",
        "amount" => 100.00,
        "description" => "Payment for groceries",
        "merchant" => "SuperMart",
    ],
    [
        "id" => 2,
        "date" => "2025-02-15",
        "amount" => 75.50,
        "description" => "Dinner with friends",
        "merchant" => "Local Restaurant",
    ],
    [
        "id" => 3,
        "date" => "2025-03-19",
        "amount" => 175.50,
        "description" => "Dinner with friends",
        "merchant" => "Draft",
    ],
    [
        "id" => 4,
        "date" => "2025-04-21",
        "amount" => 125.50,
        "description" => "Payment for groceries",
        "merchant" => "Linella",
    ],
    [
        "id" => 5,
        "date" => "2025-12-15",
        "amount" => 50.50,
        "description" => "Dinner",
        "merchant" => "ParkTown",
    ]
];

/**
 * Вычисляет общую сумму всех транзакций.
 *
 * @param array $transactions Массив транзакций
 * @return float Общая сумма
 */
function calculateTotalAmount(array $transactions): float
{
    $total = 0.0;
    foreach ($transactions as $transaction) {
        $total += (float)$transaction['amount'];
    }
    return $total;
}

/**
 * Выполняет поиск транзакций по части строки в описании.
 * Поиск осуществляется без учёта регистра.
 *
 * @param string $descriptionPart Часть строки для поиска
 * @param array $transactions Массив транзакций
 * @return array Массив найденных транзакций
 */
function findTransactionByDescription(string $descriptionPart, array $transactions): array
{
    $result = [];
    foreach ($transactions as $transaction) {
        if (stripos($transaction['description'], $descriptionPart) !== false) {
            $result[] = $transaction;
        }
    }
    return $result;
}

/**
 * Ищет транзакцию по её ID.
 * Используется array_filter и стрелочная функция.
 *
 * @param int $id Идентификатор транзакции
 * @param array $transactions Массив транзакций
 * @return array|null Найденная транзакция или null
 */
function findTransactionById(int $id, array $transactions): ?array
{
    $filtered = array_filter(
        $transactions,
        fn(array $t): bool => (int)$t['id'] === $id
    );

    return $filtered ? array_values($filtered)[0] : null;
}

/**
 * Вычисляет количество дней с момента транзакции до сегодняшнего дня.
 *
 * @param string $date Дата транзакции (YYYY-MM-DD)
 * @return int Количество дней
 */
function daysSinceTransaction(string $date): int
{
    $transactionDate = new DateTime($date);
    $today = new DateTime('today');
    $diff = $transactionDate->diff($today);
    return abs((int)$diff->days);
}

/**
 * Добавляет новую транзакцию в глобальный массив $transactions.
 *
 * @param int $id Идентификатор
 * @param string $date Дата (YYYY-MM-DD)
 * @param float $amount Сумма
 * @param string $description Описание
 * @param string $merchant Получатель
 * @return void
 */
function addTransaction(int $id, string $date, float $amount, string $description, string $merchant): void
{
    global $transactions;

    $transactions[] = [
        "id" => $id,
        "date" => $date,
        "amount" => $amount,
        "description" => $description,
        "merchant" => $merchant,
    ];
}

/**
 * Сортирует транзакции по дате (по возрастанию).
 *
 * @param array $transactions Массив транзакций
 * @return array Отсортированный массив
 */
function sortByDate(array $transactions): array
{
    $sorted = $transactions;

    usort($sorted, function (array $a, array $b): int {
        return (new DateTime($a['date'])) <=> (new DateTime($b['date']));
    });

    return $sorted;
}

/**
 * Сортировка по сумме (убывание)
 */
function sortByAmountDesc(array $transactions): array
{
    $sorted = $transactions;

    usort($sorted, fn(array $a, array $b): int => $b['amount'] <=> $a['amount']);

    return $sorted;
}
addTransaction(6, "2024-03-10", 250.00, "Online course", "EduPlatform");

$transactionsToShow = sortByDate($transactions);
$totalAmount = calculateTotalAmount($transactionsToShow);

/* -------- Галерея -------- */
$dir = 'image/';
$files = is_dir($dir) ? scandir($dir) : [];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №4</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background: #f4f6f9;
    }

    header {
        background: #2c3e50;
        color: white;
        padding: 20px;
        text-align: center;
    }

    nav {
        background: #34495e;
        padding: 10px;
        text-align: center;
    }

    nav a {
        color: white;
        margin: 0 15px;
        text-decoration: none;
        font-weight: bold;
    }

    main {
        padding: 30px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        margin-bottom: 40px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    th {
        background: #3498db;
        color: white;
    }

    tr:nth-child(even) {
        background: #f8f8f8;
    }

    .gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
    }

    .gallery img {
        width: 200px;
        height: 200px;
        object-fit: cover; /* одинаковый размер без искажения */
        border-radius: 10px;
        display: block;
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    }

    footer {
        background: #2c3e50;
        color: white;
        text-align: center;
        padding: 15px;
        margin-top: 40px;
    }
</style>

</head>
<body>

<header>
    <h1>Лабораторная работа №4</h1>
</header>

<nav>
    <a href="#transactions">Транзакции</a> |
    <a href="#gallery">Галерея</a>
</nav>

<main>

<section id="transactions">
    <h2>Список транзакций</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
        <tr>
            <th>ID</th>
            <th>Дата</th>
            <th>Сумма</th>
            <th>Описание</th>
            <th>Получатель</th>
            <th>Дней с момента</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($transactionsToShow as $transaction): ?>
            <tr>
                <td><?= htmlspecialchars((string)$transaction['id']) ?></td>
                <td><?= htmlspecialchars($transaction['date']) ?></td>
                <td><?= number_format($transaction['amount'], 2, '.', ' ') ?></td>
                <td><?= htmlspecialchars($transaction['description']) ?></td>
                <td><?= htmlspecialchars($transaction['merchant']) ?></td>
                <td><?= daysSinceTransaction($transaction['date']) ?></td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="2"><strong>Итого:</strong></td>
            <td><strong><?= number_format($totalAmount, 2, '.', ' ') ?></strong></td>
            <td colspan="3"></td>
        </tr>
        </tbody>
    </table>
</section>

<section id="gallery">

<section id="tests">
    <h2>Проверка функций</h2>

    <?php
    echo "<h3>1) calculateTotalAmount()</h3>";
    echo "<p>Общая сумма: <strong>" . number_format($totalAmount, 2, '.', ' ') . "</strong></p>";

    echo "<h3>2) findTransactionByDescription()</h3>";
    $foundDesc = findTransactionByDescription("Dinner", $transactions);
    echo "<pre>";
    print_r($foundDesc);
    echo "</pre>";

    echo "<h3>3) findTransactionById()</h3>";
    $foundId = findTransactionById(2, $transactions);
    echo "<pre>";
    var_dump($foundId);
    echo "</pre>";

    echo "<h3>4) daysSinceTransaction()</h3>";
    echo "<p>Дней с момента транзакции ID=1: <strong>" . daysSinceTransaction($transactions[0]['date']) . "</strong></p>";

    echo "<h3>5) sortByDate()</h3>";
    $testSortedDate = sortByDate($transactions);
    echo "<pre>";
    print_r($testSortedDate);
    echo "</pre>";

    echo "<h3>6) sortByAmountDesc()</h3>";
    $testSortedAmount = sortByAmountDesc($transactions);
    echo "<pre>";
    print_r($testSortedAmount);
    echo "</pre>";
    ?>
</section>
    <h2>Галерея изображений</h2>

    <div class="gallery">
        <?php foreach ($files as $file): ?>
            <?php
            if ($file !== "." && $file !== "..") {
                $path = $dir . $file;
                if (strtolower(pathinfo($path, PATHINFO_EXTENSION)) === 'jpeg') {
                    ?>
                    <img src="<?= htmlspecialchars($path) ?>" alt="image">
                    <?php
                }
            }
            ?>
        <?php endforeach; ?>
    </div>
</section>

</main>

</body>
</html>