<?php
require __DIR__ . '/src/functions.php';

$data = readData(__DIR__ . '/data.txt');
$data = handleSorting($data);

$title = 'Рецепты — PHP';
include __DIR__ . '/templates/layout.php';
include __DIR__ . '/templates/form.php';
include __DIR__ . '/templates/list.php';
?>
</div>
</body>
</html>