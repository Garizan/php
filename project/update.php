<?php
require __DIR__ . '/src/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Метод не POST');
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id <= 0) {
    exit('Неверный id');
}

$data = getRecipePostData();
$error = validateRecipeData($data);

if ($error) {
    exit($error);
}

updateRecord($id, $data);

header('Location: /index.php');
exit;