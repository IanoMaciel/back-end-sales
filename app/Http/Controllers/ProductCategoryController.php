<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller {
    protected ProductCategory $productCategory;
    public function __construct(ProductCategory $productCategory) {
        $this->productCategory = $productCategory;
    }

    public function index(): JsonResponse {
        $productCategories = $this->productCategory->query()
            ->orderBy('category')
            ->get();

        return response()->json($productCategories);
    }
}
