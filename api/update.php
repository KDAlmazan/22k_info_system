<?php
// -------------------------------------------------------
// api/update.php — Runs a named UPDATE query
// Place this file in: htdocs/myapp/api/update.php
//
// Usage (POST, JSON body):
//   fetch('api/update.php', {
//     method: 'POST',
//     headers: { 'Content-Type': 'application/json' },
//     body: JSON.stringify({
//       query: 'update_item_name',
//       params: ['New Name', 42]   // match order of ? in the SQL
//     })
//   })
//
// Response (JSON):
//   { "affected_rows": 1 }
//   { "error": "message" }   ← on failure
// -------------------------------------------------------

header('Content-Type: application/json');

require_once '../db.php';
require_once '../queries.php';

$body = json_decode(file_get_contents('php://input'), true);

$query_name = $body['query']  ?? '';
$params     = $body['params'] ?? [];

if (!array_key_exists($query_name, $UPDATE_QUERIES)) {
    http_response_code(400);
    echo json_encode(['error' => "Unknown UPDATE query: '$query_name'"]);
    exit;
}

$entry = $UPDATE_QUERIES[$query_name];
$conn  = get_connection();
$stmt  = $conn->prepare($entry['sql']);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
    $conn->close();
    exit;
}

if (!empty($params)) {
    $refs = [$entry['types']];
    foreach ($params as &$p) $refs[] = &$p;
    call_user_func_array([$stmt, 'bind_param'], $refs);
}

$stmt->execute();

echo json_encode(['affected_rows' => $stmt->affected_rows]);

$stmt->close();
$conn->close();
?>
