<?php
include 'dbinit.php';

// Create a new connection to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check if product_id is set
if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Delete product
    $delete_query = "DELETE FROM cosmetics WHERE ProductID = ?";
    $stmt = mysqli_prepare($conn, $delete_query);

    // Check if prepare() was successful
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $product_id);
        $delete_result = mysqli_stmt_execute($stmt);

        if($delete_result) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error deleting product";
        }
    } else {
        echo "Error preparing delete statement";
    }
} else {
    echo "Product ID not provided";
}

// Close the database connection
$conn->close();
?>
