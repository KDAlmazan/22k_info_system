<?php
// -------------------------------------------------------
// queries.php — Central registry for ALL your SQL queries
// Place this file in: htdocs/myapp/queries.php
// -------------------------------------------------------
// This is the ONLY file you need to edit when adding or
// changing queries. The API endpoints read from here.
//
// For DELETE and UPDATE, use ? as value placeholders.
// The matching $PARAM_TYPES entry tells PHP the data types:
//   's' = string,  'i' = integer,  'd' = double/float
// List one character per ? in the same order.
// -------------------------------------------------------


// ==== SELECT ============================================
// No parameters needed — just write the full query.
// Key = the name you pass as ?query= in your JS fetch call.

$SELECT_QUERIES = [

    'customer' =>
        "SELECT *
        FROM customer",

    'product' =>
        "SELECT p.Prod_ID, p.Prod_Name, p.Prod_Stock, p.Prod_Price, s.Supply_ID as Supplier_ID, s.Supply_Name as Supplier_Name
        FROM product p
        JOIN supplier s ON s.Supply_ID = p.Supply_ID
        ",

    'supplier' =>
        "SELECT * FROM supplier",

    // Add your own SELECT queries below:
    // 'my_query_name' => "SELECT col1, col2 FROM my_table WHERE ...",

];

// ==== DELETE ============================================
// Use ? for values that come from the user/frontend.

$DELETE_QUERIES = [

    'delete_item_by_id' => [
        'sql'    => "DELETE FROM placeholder_table WHERE id = ?",
        'types'  => 'i',   // one integer param
    ],

    // 'delete_by_name' => [
    //     'sql'   => "DELETE FROM my_table WHERE name = ?",
    //     'types' => 's',
    // ],

];

// ==== UPDATE ============================================
// List SET column params first, then the WHERE param(s) last.

$UPDATE_QUERIES = [

    'update_item_name' => [
        'sql'   => "UPDATE placeholder_table SET name = ? WHERE id = ?",
        'types' => 'si',  // string, then integer
    ],

    // 'update_status' => [
    //     'sql'   => "UPDATE my_table SET status = ? WHERE id = ?",
    //     'types' => 'si',
    // ],

];
?>
