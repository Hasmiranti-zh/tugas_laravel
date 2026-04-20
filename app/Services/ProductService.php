<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function store($data)
    {
        try {
            return Product::create($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}