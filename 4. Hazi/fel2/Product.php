<?php

class Product
{
    private int $id;
    private string $title;
    private float $price;
    private int $availableQuantity;

    // TODO Generate constructor with all properties of the class
    // TODO Generate getters and setters of properties
    /**
     * @param int $id
     * @param string $title
     * @param float $price
     * @param int $availableQuantity
     */
    public function __construct($id, $title, $price, $availableQuantity)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->availableQuantity = $availableQuantity;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getAvailableQuantity()
    {
        return $this->availableQuantity;
    }

    /**
     * @param int $availableQuantity
     */
    public function setAvailableQuantity($availableQuantity)
    {
        $this->availableQuantity = $availableQuantity;
    }


    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Cart $cart
     * @param int $quantity
     * @return CartItem
     */

    public function addToCart(Cart $cart, int $quantity): CartItem
    {
        foreach ($cart->getItems() as $item) {
            if ($item->getProduct()->getId() === $this->id) {
                $newQuantity = $item->getQuantity() + $quantity;

                if ($newQuantity > $this->availableQuantity) {
                    $newQuantity = $this->availableQuantity;
                }
                $item->getQuantity($newQuantity);
            }
        }

        $newQuantity = $quantity;

        if ($newQuantity > $this->availableQuantity) {
            $newQuantity = $this->$quantity;
        }

        $cartItem = new CartItem($this, $newQuantity);
        $items = $cart->getItems();
        $items[] = $cartItem;
        $cart->setItems($items);

        return $cartItem;
    }

    /**
     * Remove product from cart
     *
     * @param Cart $cart
     */
    public function removeFromCart(Cart $cart)
    {
        $items = $cart->getItems();

        foreach ($items as $index => $item) {
            if ($item->getProduct()->getId() === $this->id) {
                unset($items[$index]);
                $cart->setItems(array_values($items)); // Frissítjük a kosár elemeit újraindexelés után
                return;
            }
        }
    }
}