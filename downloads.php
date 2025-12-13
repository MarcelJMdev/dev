<?php
$plugin = $_GET['plugin'] ?? null;

if (!$plugin) {
    http_response_code(400);
    exit("Plugin fehlt");
}

// FESTER Dateiname (dein echtes Plugin)
$fileName = "StatsPlugin-1.0.0.jar";
$filePath = __DIR__ . "/plugins/" . $fileName;
$dataFile = __DIR__ . "/downloads.json";

if (!file_exists($filePath)) {
    http_response_code(404);
    exit("Datei nicht gefunden");
}

// JSON laden
$data = json_decode(file_get_contents($dataFile), true);
if (!is_array($data)) {
    $data = [];
}

// Zähler erhöhen
if (!isset($data[$plugin])) {
    $data[$plugin] = 0;
}
$data[$plugin]++;

// Speichern
file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

// Datei ausliefern
header("Content-Type: application/java-archive");
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Length: " . filesize($filePath));
readfile($filePath);
exit;
