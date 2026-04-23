<?php
require __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates_twig');
$twig = new \Twig\Environment($loader);

$filter = new \Twig\TwigFilter('format_time', function ($minutes) {
    $minutes = (int)$minutes;
    return intdiv($minutes, 60) . 'h ' . ($minutes % 60) . 'm';
});
$twig->addFilter($filter);

return $twig;