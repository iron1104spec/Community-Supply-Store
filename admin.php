<?php

include 'config/db.php';

$sql = "SELECT
    orders.order_id,
    customers.customer_name,
    customers.contact,
    products.product_name,
    orders.quantity,
    orders.order_date
FROM orders
INNER JOIN customers
ON orders.customer_id = customers.customer_id
INNER JOIN products
ON orders.product_id = products.product_id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Order List</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <header class="header">
        <h1>COMMUNITY SUPPLY STORE</h1>
        <p>Administrator Dashboard</p>
    </header>

    <main class="container">

        <section class="admin-section">

            <h2>Customer Orders</h2>

            <div class="table-container">

                <table class="admin-table">

                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>

                    <?php while ($row = $result->fetch_assoc()) { ?>

                    <tr>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['order_date']; ?></td>

                        <td>
                            <a class="delete-btn"
                               href="delete.php?order_id=<?php echo $row['order_id']; ?>"
                               onclick="return confirm('Are you sure you want to delete this order?');">
                               Delete
                            </a>
                        </td>
                    </tr>

                    <?php } ?>

                </table>

            </div>

            <a class="back-link" href="index.php">Back to Homepage</a>

        </section>

    </main>

</body>
</html>
