<?php require_once('../inc/header.php'); ?>

<?php
// التحقق من وجود السلة
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];
$totalPrice = 0; // لحساب المجموع الكلي

// تحديث الكميات في السلة
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $index => $quantity) {
        // التحقق من أن الكمية رقم صحيح وغير سالبة
        if (is_numeric($quantity) && $quantity > 0) {
            $_SESSION['cart'][$index]['quantity'] = (int)$quantity; // تحديث الكمية
        }
    }
    // إعادة تحميل الصفحة لتطبيق التحديث
    header("Location: cart.php");
    exit;
}

// حذف منتج من السلة
if (isset($_GET['delete'])) {
    $productIdToDelete = $_GET['delete'];
    // البحث عن المنتج في السلة وحذفه
    foreach ($_SESSION['cart'] as $index => $item) {
        if (isset($item['id']) && $item['id'] == $productIdToDelete) {
            unset($_SESSION['cart'][$index]); // حذف المنتج
            break;
        }
    }
    // إعادة ترتيب السلة
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    // إعادة تحميل الصفحة لتحديث السلة
    header("Location: cart.php");
    exit;
}

// حساب السعر الإجمالي
foreach ($cart as $item) {
    if (isset($item['price'], $item['quantity'])) {
        $totalPrice += $item['price'] * $item['quantity'];
    }
}
?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shopping Cart</h1>
        </div>
    </div>
</header>

<!-- Cart Section-->
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
                        <tbody>
                            <?php if (!empty($cart)): ?>
                                <?php foreach ($cart as $index => $item): ?>
                                    <!-- التأكد من وجود البيانات -->
                                    <?php if (isset($item['id'], $item['name'], $item['price'], $item['quantity'])): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                                            <td>
                                                <input type="number" name="quantity[<?php echo $index; ?>]" value="<?php echo $item['quantity']; ?>" min="1">
                                            </td>
                                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                            <td>
                                                <a href="?delete=<?php echo $item['id']; ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total Price:</strong></td>
                                    <td colspan="2"><h3>$<?php echo number_format($totalPrice, 2); ?></h3></td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right">
                                        <button type="submit" name="update_cart" class="btn btn-primary">Update Cart</button>
                                        <a href="checkout.php" class="btn btn-primary">Checkout</a>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Your cart is empty. <a href="shop.php">Continue Shopping</a></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once('../inc/footer.php'); ?>
