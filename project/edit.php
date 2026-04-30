<?php
require __DIR__ . '/src/functions.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    http_response_code(400);
    exit('Неверный id');
}

$recipe = getRecordById($id);
if (!$recipe) {
    http_response_code(404);
    exit('Запись не найдена');
}

$title = 'Редактировать рецепт';

include __DIR__ . '/templates/layout.php';
include __DIR__ . '/templates/edit_form.php';