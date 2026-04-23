<?php
require __DIR__ . '/src/functions.php';

$twig = require __DIR__ . '/twig.php';

$data = readData(__DIR__ . '/data.txt');
$data = handleSorting($data);

echo $twig->render('list.twig', [
    'data' => $data
]);