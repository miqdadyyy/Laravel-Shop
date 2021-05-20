<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::get();
        return view('pages.homepage', compact('product_categories'));
    }

    public function productList(ProductCategory $category = null)
    {
        if($category) $products = $category->products()->simplePaginate(10);
        else $products = Product::simplePaginate(10);
        return view('pages.product-category', compact('products', 'category'));
    }

    public function productDetail(Product $product)
    {
        return view('pages.product-detail', compact('product'));
    }
}
