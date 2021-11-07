<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ProductService;


class ProductsController extends Controller
{
    public function index() {
        return User::with('products')->get();
    }

    public function saveProducts()
    {
        $productService = new ProductService();
        $products = $productService->readProductsForRemote();
        $productService->saveProducts($products);

        return response()->json('Ürünler Kaydedildi.');
    }

    public function sendProducts()
    {
        $productService = new ProductService();
        $products = $productService->getProducts();
        $productService->addProductsForRemote($products);
        return response()->json('Ürünler Gönderildi.');
    }
}
