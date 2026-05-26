<?php
// -------------------------------------------------------
// api/test.php — Diagnostic tool
// Visit: http://localhost/myapp/api/test.php
//
// DELETE THIS FILE once everything is working.
// -------------------------------------------------------

// Turn errors ON here so you can see exactly what's wrong
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$result = [];

// 1. Confirm PHP is running and __DIR__ resolves correctly
$result['php_ok']   = true;
$result['this_dir'] = __DIR__;
$result['db_path']  = __DIR__ . '/../db.php';
$result['q_path']   = __DIR__ . '/../queries.php';

// 2. Check the required files actually exist on disk
$result['db_file_exists']      = file_exists(__DIR__ . '/../db.php');
$result['queries_file_exists'] = file_exists(__DIR__ . '/../queries.php');

// 3. Try loading them
if ($result['db_file_exists']) {
    require_once __DIR__ . '/../db.php';
    $result['db_php_loaded'] = true;
} else {
    $result['db_php_loaded'] = false;
}

// 4. Try the DB connection
if ($result['db_php_loaded']) {
    try {
        $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            $result['db_connection'] = 'FAILED: ' . $conn->connect_error;
        } else {
            $result['db_connection'] = 'OK';
            $conn->close();
        }
    } catch (Exception $e) {
        $result['db_connection'] = 'Exception: ' . $e->getMessage();
    }
}

// 5. Check queries.php loads and has the expected arrays
if ($result['queries_file_exists']) {
    require_once __DIR__ . '/../queries.php';
    $result['SELECT_QUERIES_keys'] = array_keys($SELECT_QUERIES);
    $result['DELETE_QUERIES_keys'] = array_keys($DELETE_QUERIES);
    $result['UPDATE_QUERIES_keys'] = array_keys($UPDATE_QUERIES);
}

echo json_encode($result, JSON_PRETTY_PRINT);
?>
