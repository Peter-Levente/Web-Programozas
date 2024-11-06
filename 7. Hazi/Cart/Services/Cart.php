<?php

namespace Cart\Services;

use Cart\Models\CartItem;
use Cart\Models\Product;

class Cart
{
    private array $items = [];


    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->loadFromSession();
    }

    public function addItem(Product $product): void
    {
        $productId = $product->getId();
        if (isset($this->items[$productId])) {
            $this->items[$productId]->incrementQuantity();
        } else {
            $this->items[$productId] = new CartItem($product);
        }
        $this->saveToSession();
    }

    public function updateItemQuantity(int $productId, int $quantity): void
    {
        if (isset($this->items[$productId])) {
            $this->items[$productId]->setQuantity($quantity);
            if ($this->items[$productId]->getQuantity() <= 0) {
                unset($this->items[$productId]);
            }
            $this->saveToSession();
        }
    }

    public function removeItem(int $productId): void
    {
        if (isset($this->items[$productId])) {
            $this->items[$productId]->decrementQuantity();
            if ($this->items[$productId]->getQuantity() === 0) {
                unset($this->items[$productId]);
            }
            $this->saveToSession();
        }
    }

    public function deleteItem(int $productId): void
    {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
            $this->saveToSession();
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotalPrice(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getSubtotal();
        }
        return $total;
    }

    private function loadFromSession(): void
    {
        if (isset($_SESSION['cart_items'])) {
            foreach ($_SESSION['cart_items'] as $productId => $itemData) {
                $product = new Product($productId, $itemData['name'], $itemData['price']);
                $this->items[$productId] = new CartItem($product, $itemData['quantity']);
            }
        }
    }

    private function saveToSession(): void
    {
        $_SESSION['cart_items'] = [];
        foreach ($this->items as $productId => $item) {
            $_SESSION['cart_items'][$productId] = [
                'name' => $item->getProduct()->getName(),
                'price' => $item->getProduct()->getPrice(),
                'quantity' => $item->getQuantity()
            ];
        }
    }
}