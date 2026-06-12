<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$jsonFile = 'trophies.json';

if (!file_exists($jsonFile)) {
    http_response_code(404);
    echo json_encode(['error' => 'Trophies data not found.']);
    exit;
}

$raw  = file_get_contents($jsonFile);
$data = json_decode($raw, true);

if ($data === null) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to parse trophies data.']);
    exit;
}


if (isset($_GET['category']) && !empty($_GET['category'])) {
    $cat = strtolower(trim($_GET['category']));
    $data['trophies'] = array_values(array_filter($data['trophies'], function($t) use ($cat) {
        return strtolower($t['category']) === $cat;
    }));
}

echo json_encode($data, JSON_PRETTY_PRINT);
