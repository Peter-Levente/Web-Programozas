<?php

class Cart
{
    /**
     * @var CartItem[]
     */
    private array $items = [];

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    // TODO Generate getters and setters of properties


    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Product $product
     * @param int $quantity
     * @return CartItem
     */
    public function addProduct(Product $product, int $quantity): CartItem
    {
        $items = $this->getItems();

        foreach ($items as $item) {
            if ($item->getProduct()->getId() === $product->getId()) {
                $newQuantity = $item->getQuantity() + $quantity;

                if ($newQuantity > $product->getAvailableQuantity()) {
                    $newQuantity = $product->getAvailableQuantity();
                }
                $item->setQuantity($newQuantity);
                return $item; // Ha a termék már a kosárban van, itt kilépünk
            }
        }

        $newQuantity = $quantity;

        if ($newQuantity > $product->getAvailableQuantity()) {
            $newQuantity = $product->getAvailableQuantity();
        }

        $cartItem = new CartItem($product, $newQuantity);
        $items[] = $cartItem;
        $this->setItems($items);

        return $cartItem;
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        $items = $this->getItems();

        foreach ($items as $index => $item) {
            if ($item->getProduct()->getId() === $product->getId()) {
                unset($items[$index]);

                // Újrendeljük az indexeket, hogy ne legyenek üres helyek a tömbben
                $items = array_values($items);
                $this->setItems($items);
                return;
            }
        }
    }

    /**
     * This returns total number of products added in cart
     *
     * @return int
     */
    public function getTotalQuantity(): int
    {
        $totalQuantity = 0;

        foreach ($this->getItems() as $item) {
            $totalQuantity += $item->getQuantity();
        }
        return $totalQuantity;
    }

    /**
     * This returns total price of products added in cart
     *
     * @return float
     */
    public function getTotalSum(): float
    {
        $totalSum = 0.0;

        foreach ($this->getItems() as $item) {
            $totalSum += $item->getProduct()->getPrice() * $item->getQuantity();
        }
        return $totalSum;
    }
}