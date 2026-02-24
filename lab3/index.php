<?php
$day = (int)date('N');

$johnSchedule = '';
$janeSchedule = '';

// John Styles: Пн, Ср, Пт
if ($day === 1 || $day === 3 || $day === 5) {
    $johnSchedule = '8:00-12:00';
} else {
    $johnSchedule = 'Нерабочий день';
}

// Jane Doe: Вт, Чт, Сб
if ($day === 2 || $day === 4 || $day === 6) {
    $janeSchedule = '12:00-16:00';
} else {
    $janeSchedule = 'Нерабочий день';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №3</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 500px; margin-bottom: 30px; }
        th, td { border: 1px solid black; padding: 8px; }
        th { background-color: #f2f2f2; }
        h2 { margin-top: 40px; }
    </style>
</head>
<body>

<h2>1. Расписание сотрудников</h2>
<p>Текущий день недели (date('N')): <strong><?= $day ?></strong></p>

<table>
    <tr>
        <th>№</th>
        <th>Фамилия Имя</th>
        <th>График работы</th>
    </tr>
    <tr>
        <td>1</td>
        <td>John Styles</td>
        <td><?= $johnSchedule ?></td>
    </tr>
    <tr>
        <td>2</td>
        <td>Jane Doe</td>
        <td><?= $janeSchedule ?></td>
    </tr>
</table>

<h2>2. Цикл FOR</h2>

<?php
$a = 0;
$b = 0;

for ($i = 0; $i <= 5; $i++) {
    $a += 10;
    $b += 5;
    echo "Шаг $i: a = $a, b = $b <br>";
}

echo "End of the loop: a = $a, b = $b";
?>

<h2>3. Цикл WHILE</h2>

<?php
$a = 0;
$b = 0;
$i = 0;

while ($i <= 5) {
    $a += 10;
    $b += 5;
    echo "Шаг $i: a = $a, b = $b <br>";
    $i++;
} 

echo "End of the loop: a = $a, b = $b";
?>

<h2>4. Цикл DO-WHILE</h2>

<?php
$a = 0;
$b = 0;
$i = 0;

do {
    $a += 10;
    $b += 5;
    echo "Шаг $i: a = $a, b = $b <br>";
    $i++;
} while ($i <= 5);

echo "End of the loop: a = $a, b = $b";
?>

</body>
</html>