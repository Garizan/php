<?php
require __DIR__ . '/src/functions.php';

$sort = $_GET['sort'] ?? 'id_desc';

if (!empty($_GET['q'])) {
    $data = searchRecords((string)$_GET['q'], $sort);
} else {
    $data = getAllRecords($sort);
}

$title = 'Рецепты — PHP';

include __DIR__ . '/templates/layout.php';
include __DIR__ . '/templates/form.php';
include __DIR__ . '/templates/list.php';