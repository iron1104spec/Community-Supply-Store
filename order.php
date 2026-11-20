
<?php
include 'config/db.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customer_name = $_POST['customer_name'];
    $contact = $_POST['contact'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Validate quantity
    if (!is_numeric($quantity) || $quantity < 1) {
        echo json_encode([
            "success" => false,
            "message" => "Please enter a valid quantity."
        ]);
        exit;
    }

    // Save customer information
    $sql = "INSERT INTO customers (customer_name, contact)
            VALUES (?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $customer_name, $contact);

    if ($stmt->execute()) {

        $customer_id = $conn->insert_id;

        // Save order information
        $sql = "INSERT INTO orders (customer_id, product_id, quantity)
                VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $customer_id, $product_id, $quantity);

        if ($stmt->execute()) {

            echo json_encode([
                "success" => true,
                "message" => "Your order has been placed successfully!"
            ]);

        } else {

            echo json_encode([
                "success" => false,
                "message" => "Error placing your order."
            ]);

        }

    } else {

        echo json_encode([
            "success" => false,
            "message" => "Error saving customer information."
        ]);

    }

} else {

    echo json_encode([
        "success" => false,
        "message" => "Please submit the order form first."
    ]);

}
?>
