<?php require_once("../inc/header.php"); 
if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $totalPrice = 0; 
    if (isset($_POST['update_cart']) && isset($_POST['quantity']) && is_array($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $index => $quantity) {
            $quantity = filter_var(
                $quantity,
                FILTER_VALIDATE_INT,
                ['options' => ['min_range' => 1]]
            ) ?? 1;
            if (isset($_SESSION['cart'][$index])) {
                $_SESSION['cart'][$index]['quantity'] = $quantity;
            }
        }
        $_SESSION['message'] = "The cart was updated successfully.";
    } 
    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        foreach ($cart as $index => $item) {
            if ($item['product_id'] == $delete_id) {
                unset($cart[$index]);
                $_SESSION['cart'] = array_values($cart);
                $_SESSION['message'] = "Product removed from cart.";
                break;
            }
        }
    } 
    foreach ($cart as $item) {
        if (isset($item['product_price'], $item['quantity'])) {
            $totalPrice += $item['product_price'] * $item['quantity'];
        }
    }
} else {
    $cart = [];
    $totalPrice = 0;
    $_SESSION['message'] = "Your cart is empty.";
} ?>
<!-- Header -->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shopping Cart</h1>
        </div>
    </div>
</header> <!-- Cart Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="cart.php">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody> <?php if (!empty($cart)): ?>     <?php foreach ($cart as $index => $item): ?>
                                    <?php if (isset($item['product_id'], $item['product_name'], $item['product_price'], $item['quantity'])): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                            <td>$<?php echo number_format($item['product_price'], 2); ?></td>
                                            <td> <input type="number" name="quantity[<?php echo $index; ?>]"
                                                    value="<?php echo $item['quantity']; ?>" min="1" class="form-control" /> </td>
                                            <td>$<?php echo number_format($item['product_price'] * $item['quantity'], 2); ?></td>
                                            <td> <a href="cart.php?delete=<?php echo htmlspecialchars($item['product_id']); ?>"
                                                    class="btn btn-danger">Delete</a> </td>
                                        </tr> <?php endif; ?>     <?php endforeach; ?>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total Price:</strong></td>
                                    <td colspan="2">
                                        <h3>$<?php echo number_format($totalPrice, 2); ?></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right"> <button type="submit" name="update_cart"
                                            class="btn btn-primary">Update Cart</button> <a href="checkout.php"
                                            class="btn btn-primary">Checkout</a> </td>
                                </tr> <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Your cart is empty. <a href="./index.php">Continue
                                            Shopping</a></td>
                                </tr> <?php endif; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once('../inc/footer.php'); ?>