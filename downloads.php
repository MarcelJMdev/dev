<?php
// Fehler anzeigen (nur zum Debuggen, später entfernen)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$fileName = "StatsPlugin-1.0.0.jar";
$filePath = __DIR__ . "/plugins/" . $fileName;

if (!file_exists($filePath)) {
    http_response_code(404);
    echo "DATEI NICHT GEFUNDEN: " . $filePath;
    exit;
}

// Sauberer Download für alle Browser
header('Content-Description: File Transfer');
header('Content-Type: application/java-archive');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));

flush();
readfile($filePath);
exit;
