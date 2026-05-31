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

$SELECT_QUERIES =
[

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

    'deliverystock' =>
        "SELECT *
        FROM deliverystock",

    // Add your own SELECT queries below:
    // 'my_query_name' => "SELECT col1, col2 FROM my_table WHERE ...",

];

// ==== DELETE ============================================
// Use ? for values that come from the user/frontend.

$DELETE_QUERIES =
[

    'customer' =>
    [
        'sql'    => "DELETE FROM customer WHERE Cust_ID = ?",
        'types'  => 'i',   // one integer param
    ],

    'product' =>
    [
        'sql'    => "DELETE FROM product WHERE Prod_ID = ?",
        'types'  => 'i',   // one integer param
    ],

    'supplier' =>
    [
        'sql'    => "DELETE FROM supplier WHERE Supply_ID = ?",
        'types'  => 'i',   // one integer param
    ],

    'deliverystock' =>
    [
        'sql'    => "DELETE FROM deliverystock WHERE DStock_ID = ?",
        'types'  => 'i',   // one integer param
    ],
];

// ==== UPDATE ============================================
// List SET column params first, then the WHERE param(s) last.

$UPDATE_QUERIES =
[

    'customer' =>
    [
        'sql'   => "UPDATE customer SET Cust_Name = ?, Cust_Address = ?, Cust_PhoneNum = ? WHERE Cust_ID = ?",
        'types' => 'sssi',  // string, string, string, then integer
    ],

    'product' =>
    [
        'sql'   => "UPDATE product SET Supply_ID = ?, Prod_Name = ?, Prod_Stock = ?, Prod_Price = ? WHERE Prod_ID = ?",
        'types' => 'isidi',  // string, integer, double, integer, then integer
    ],

    'supplier' =>
    [
        'sql'   => "UPDATE supplier SET Supply_Name = ?, Supply_PhoneNum = ?, Supply_City = ?, Supply_State = ?, Supply_ZipCode = ? WHERE Supply_ID = ?",
        'types' => 'ssssii',  // string, string, string, string, string, then integer
    ],

    'deliverystock' =>
    [
        'sql'   => "UPDATE deliverystock SET Prod_ID = ?, DStock_Date = ?, DStock_Stock = ? WHERE DStock_ID = ?",
        'types' => 'isii',  // integer, integer, integer, string, then integer
    ],

    // 'update_status' => [
    //     'sql'   => "UPDATE my_table SET status = ? WHERE id = ?",
    //     'types' => 'si',
    // ],

];
?>
