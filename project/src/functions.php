<?php

function readData(string $file): array
{
    if (!file_exists($file)) {
        return [];
    }

    $json = file_get_contents($file);
    $data = json_decode($json, true);

    return is_array($data) ? $data : [];
}

function sortData(array $data, string $field): array
{
    $allowed = ['title', 'category', 'created_at', 'difficulty', 'author', 'prep_time'];
    if (!in_array($field, $allowed, true)) {
        return $data;
    }

    usort($data, function ($a, $b) use ($field) {
        return strcmp((string)($a[$field] ?? ''), (string)($b[$field] ?? ''));
    });

    return $data;
}

function handleSorting(array $data): array
{
    if (isset($_GET['sort'])) {
        return sortData($data, (string)$_GET['sort']);
    }

    return $data;
}