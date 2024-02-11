<?php
define('DB_USER', 'root');
define('DB_PASSWORD', 'Nonaphu2');
define('DB_HOST', 'localhost');
define('DB_NAME', 'Skincare');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
    OR die('Could not connect to MySQL: ' . mysqli_connect_error());
mysqli_set_charset($dbc, 'utf8');

if (!function_exists('prepare_string')) {
    function prepare_string($dbc, $string) {
        $string_trimmed = trim($string);
        $string = mysqli_real_escape_string($dbc, $string_trimmed);
        return $string;
    }
}
$sql_create_db = "CREATE DATABASE IF NOT EXISTS Skincare";
if (!mysqli_query($dbc, $sql_create_db)) {
    echo "Error in creation of database: " . mysqli_error($dbc);
}


mysqli_select_db($dbc, DB_NAME);


// SQL to create table
$sql_create_table = "CREATE TABLE IF NOT EXISTS cosmetics (
    ProductID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ProductName VARCHAR(100) NOT NULL,
    Category VARCHAR(100) NOT NULL,
    Description TEXT,
    QuantityAvailable INT(6),
    Price DECIMAL(10, 2),
    ProductAddedBy VARCHAR(255) DEFAULT 'RachnaShukla'
)";
?>
