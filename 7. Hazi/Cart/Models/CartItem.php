<?php

namespace Cart\Models;

class CartItem
{
    private Product $product;
    private int $quantity;

    public function __construct(Product $product, int $quantity = 1)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function incrementQuantity(): void
    {
        $this->quantity++;
    }

    public function decrementQuantity(): void
    {
        if ($this->quantity > 0) {
            $this->quantity--;
        }
    }

    public function getSubtotal(): float
    {
        return $this->product->getPrice() * $this->quantity;
    }
}