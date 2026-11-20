
<?php
include 'config/db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Product image filenames
$images = [
    "Rice" => "rice.jpg",
    "Tissue" => "tissue.jpg",
    "Cooking Oil" => "cooking oil.jpg",
    "Itlog" => "itlog.jpg",
    "Buseng" => "buseng.jpg"
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Community Supply Store</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/style.css?v=4">
    <script src="assets/script.js?v=2" defer></script>
</head>

<body>

    <!-- Header -->
    <header class="header">
        <h1>COMMUNITY SUPPLY STORE</h1>
        <p>Your Daily Essentials, All in One Place.</p>
    </header>

    <main class="container">

        <!-- Introduction -->
        <section class="intro">
            <h2>Welcome to Our Store!</h2>
            <p>Find the everyday essentials you need in one convenient place.</p>
        </section>

        <!-- Product Categories -->
        <section class="categories">
            <h2>Product Categories</h2>

            <div class="category-list">
                <span>Groceries</span>
                <span>Household Supplies</span>
                <span>Personal Care</span>
                <span>Stationery</span>
            </div>
        </section>

        <!-- Products -->
        <section class="products">
            <h2>Our Products</h2>

            <div class="product-grid">

                <?php while ($row = $result->fetch_assoc()) {

                    $product_name = $row['product_name'];
                    $image = $images[$product_name] ?? '';

                ?>

                    <div class="product-card">

                        <!-- Product Image -->
                        <?php if ($image != '') { ?>
                            <img
                                src="assets/images/<?php echo $image; ?>"
                                alt="<?php echo $product_name; ?>"
                            >
                        <?php } ?>

                        <!-- Product Information -->
                        <h3><?php echo $product_name; ?></h3>

                        <p class="price">
                            ₱<?php echo $row['price']; ?>
                        </p>

                        <p class="stock">
                            Available Stock: <?php echo $row['stock']; ?>
                        </p>

                        <!-- Order Now Button -->
                        <button
                            type="button"
                            class="order-now-btn"
                            onclick="document.getElementById('orderModal<?php echo $row['product_id']; ?>').showModal()"
                        >
                            Order Now
                        </button>

                        <!-- Order Modal -->
                        <dialog
                            class="order-modal"
                            id="orderModal<?php echo $row['product_id']; ?>"
                        >

                            <div class="modal-header">
                                <h2>Place Your Order</h2>

                                <button
                                    type="button"
                                    class="close-modal"
                                    onclick="this.closest('dialog').close()"
                                >
                                    &times;
                                </button>
                            </div>

                            <p class="modal-product">
                                Product: <strong><?php echo $product_name; ?></strong>
                            </p>

                            <p class="modal-price">
                                Price: ₱<?php echo $row['price']; ?>
                            </p>

                            <form action="order.php" method="POST">

                                <input
                                    type="hidden"
                                    name="product_id"
                                    value="<?php echo $row['product_id']; ?>"
                                >

                                <label>Customer Name:</label>
                                <input
                                    type="text"
                                    name="customer_name"
                                    required
                                >

                                <label>Contact Number:</label>
                                <input
                                    type="tel"
                                    name="contact"
                                    required
                                >

                                <label>Quantity:</label>
                                <input
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    max="<?php echo $row['stock']; ?>"
                                    required
                                >

                                <button
                                    type="submit"
                                    class="place-order-btn"
                                >
                                    Place Order
                                </button>

                            </form>

                        </dialog>

                    </div>

                <?php } ?>

            </div>
        </section>

        <!-- Order Success Modal -->
        <dialog class="success-modal" id="successModal">

            <div class="success-content">

                <div class="success-icon">✓</div>

                <h2>Order Placed Successfully!</h2>

                <p>
                    Thank you for ordering from our store.
                    Your order has been saved.
                </p>

                <button
                    type="button"
                    class="continue-btn"
                    onclick="document.getElementById('successModal').close()"
                >
                    Continue Shopping
                </button>

            </div>

        </dialog>

        <!-- Footer -->
        <footer>
            <h3>Contact Us</h3>
            <p>Email: info@communitysupplystore.com</p>
            <p>Community Supply Store | All Rights Reserved</p>
        </footer>

    </main>

</body>
</html>
