<?php
// -------------------------------------------------------
// api/select.php — Runs a named SELECT query
// Place this file in: htdocs/myapp/api/select.php
//
// Usage (GET):
//   fetch('api/select.php?query=get_all_items')
//
// Response (JSON):
//   { "data": [ {col: val, ...}, ... ] }
//   { "error": "message" }           ← on failure
// -------------------------------------------------------

header('Content-Type: application/json');

require_once '../db.php';
require_once '../queries.php';

// Read the query name from the URL: ?query=your_query_name
$query_name = $_GET['query'] ?? '';

// Reject unknown query names (prevents arbitrary SQL being injected via this param)
if (!array_key_exists($query_name, $SELECT_QUERIES)) {
    http_response_code(400);
    echo json_encode(['error' => "Unknown SELECT query: '$query_name'"]);
    exit;
}

$conn = get_connection();
$result = $conn->query($SELECT_QUERIES[$query_name]);

if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => $conn->error]);
    $conn->close();
    exit;
}

// Collect all rows into an array and return as JSON
$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

echo json_encode(['data' => $rows]);
$conn->close();
?>
