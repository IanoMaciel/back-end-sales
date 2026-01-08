<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;

class SubcategoryController extends Controller {
    protected Subcategory $subcategory;

    public function __construct(Subcategory $subcategory) {
        $this->subcategory = $subcategory;
    }

    public function index(): JsonResponse {
        $categories = $this->subcategory->query()
            ->orderBy('category_id')
            ->get();

        return response()->json($categories, 200);
    }
}
