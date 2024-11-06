<?php

namespace Cart\Services;

use Cart\Models\Product;

class ProductRepository
{
    private array $products = [];

    public function __construct()
    {
        // Sample product data
        $this->products = [
            new Product(1, 'Product A', 10.99),
            new Product(2, 'Product B', 14.99),
            new Product(3, 'Product C', 19.99)
        ];
    }

    public function getAllProducts(): array
    {
        return $this->products;
    }

    public function getProductById(int $id): ?Product
    {
        foreach ($this->products as $product) {
            if ($product->getId() === $id) {
                return $product;
            }
        }
        return null;
    }
}