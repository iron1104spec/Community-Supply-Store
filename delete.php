<?php

include 'config/db.php';

$id = $_GET['order_id'];

$sql = "DELETE FROM orders WHERE order_id = ?"; 

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<h1>Order Deleted Successfully!</h1>";
    echo "<a href='admin.php'>Back to Admin Order List</a>";
} else {
    echo "Error deleting order: " . $stmt->error;
}   

?>