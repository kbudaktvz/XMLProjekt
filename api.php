<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$jsonFile = 'squad.json';

if (!file_exists($jsonFile)) {
    http_response_code(404);
    echo json_encode(['error' => 'Squad data not found.']);
    exit;
}

$raw = file_get_contents($jsonFile);
$data = json_decode($raw, true);

if ($data === null) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to parse squad data.']);
    exit;
}


if (isset($_GET['position']) && !empty($_GET['position'])) {
    $pos = strtolower(trim($_GET['position']));
    $data['players'] = array_values(array_filter($data['players'], function($p) use ($pos) {
        return strtolower($p['position']) === $pos;
    }));
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $found = null;
    foreach ($data['players'] as $p) {
        if ($p['id'] === $id) { $found = $p; break; }
    }
    if ($found) {
        echo json_encode($found, JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Player not found.']);
    }
    exit;
}

echo json_encode($data, JSON_PRETTY_PRINT);
