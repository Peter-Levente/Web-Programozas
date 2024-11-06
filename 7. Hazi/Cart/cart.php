<?php
require_once 'autoload.php';

use Cart\Services\Cart;

//session_start();

$cart = new Cart();

/// Mennyiség növelése
if (isset($_POST['increment_quantity'])) {
    $productId = (int)$_POST['product_id'];
    $cart->addItem($cart->getItems()[$productId]->getProduct());
}

// Mennyiség csökkentése, de csak 1-ig
if (isset($_POST['decrement_quantity'])) {
    $productId = (int)$_POST['product_id'];
    $item = $cart->getItems()[$productId];

    // Csak akkor csökkenti, ha a mennyiség nagyobb, mint 1
    if ($item->getQuantity() > 1) {
        $cart->removeItem($productId);
    }
}

// Termék eltávolítása a kosárból
if (isset($_POST['remove_from_cart'])) {
    $productId = (int)$_POST['product_id'];
    $cart->deleteItem($productId); // Teljes termék eltávolítása
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
</head>
<body>
<h1>Shopping Cart</h1>
<ul>
    <?php foreach ($cart->getItems() as $productId => $item) { ?>
        <li>
            <form method="post">
                <?php echo htmlspecialchars($item->getProduct()->getName()); ?> -
                $<?php echo number_format($item->getProduct()->getPrice(), 2); ?>
                <!-- Mennyiség megjelenítése -->
                (Mennyiség: <?php echo $item->getQuantity(); ?>)

                <!-- Mennyiség növelése gomb -->
                <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                <button type="submit" name="increment_quantity">+</button>

                <!--                     Mennyiség csökkentése gomb -->
                <button type="submit" name="decrement_quantity">-</button>

                <!-- Eltávolítás a kosárból gomb -->
                <button type="submit" name="remove_from_cart">Eltávolítás a kosárból</button>
            </form>
        </li>
    <?php } ?>
</ul>

<p>Total Price: $<?php echo number_format($cart->getTotalPrice(), 2); ?></p>
</body>
</html>