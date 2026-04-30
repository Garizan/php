<?php
require __DIR__ . '/src/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Метод не POST');
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id <= 0) {
    exit('Неверный id');
}

deleteRecord($id);

header('Location: /index.php');
exit;