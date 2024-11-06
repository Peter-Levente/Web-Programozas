<?php
require_once 'autoload.php';

use Cart\Services\Cart;
use Cart\Services\ProductRepository;

//session_start();

$productRepository = new ProductRepository();
$cart = new Cart();

if (isset($_POST['add_to_cart'])) {
    $productId = (int)$_POST['product_id'];
    $product = $productRepository->getProductById($productId);
    if ($product) {
        $cart->addItem($product);
    }
}

if (isset($_POST['view_cart'])) {
    header('Location: cart.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
</head>
<body>
<h1>Product List</h1>
<ul>
    <?php foreach ($productRepository->getAllProducts() as $product) { ?>
        <li>
            <form method="post">
                <?php echo htmlspecialchars($product->getName()); ?> -
                $<?php echo number_format($product->getPrice(), 2); ?>
                <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
                <input type="submit" name="add_to_cart" value="Add to Cart">
            </form>
        </li>
    <?php } ?>
</ul>

<form method="post">
    <input type="submit" name="view_cart" value="View Cart">
</form>
</body>
</html>