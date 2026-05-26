<?php
// -------------------------------------------------------
// db.php — Database connection
// Place this file in: htdocs/myapp/db.php
// -------------------------------------------------------

// Update these four values to match your XAMPP setup.
// Default XAMPP: host=localhost, user=root, pass=(empty)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', '22k_db');

/**
 * Returns a live MySQLi connection.
 * All API files call this instead of connecting on their own,
 * so you only ever change credentials in one place.
 */
function get_connection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        http_response_code(500);
        die(json_encode(['error' => 'DB connection failed: ' . $conn->connect_error]));
    }

    $conn->set_charset('utf8mb4');

    return $conn;
}
?>
