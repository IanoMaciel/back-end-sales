<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    protected Category $category;
    protected Subcategory $subcategory;

    public function __construct(Category $category, Subcategory $subcategory) {
        $this->category = $category;
        $this->subcategory = $subcategory;
    }

    public function index(): JsonResponse {
        $categories = $this->category->query()
            ->orderBy('category')
            ->with(['subcategories'])
            ->get();

        return response()->json($categories, 200);
    }

    public function store(StoreCategoryRequest $request): JsonResponse {
        $validatedData = $request->validated();

        $category = DB::transaction(function () use ($validatedData) {

            $category = $this->category->create([
                'category' => $validatedData['category'],
            ]);

            if (!empty($validatedData['subcategories'])) {
                foreach ($validatedData['subcategories'] as $subcategory) {
                    $this->subcategory->create([
                        'category_id' => $category->id,
                        'subcategory' => $subcategory['subcategory'],
                    ]);
                }
            }

            return $category;
        });

        return response()->json($category->load('subcategories'), 201);
    }


    public function show(int $id): JsonResponse {
        $categories = $this->category->query()
            ->with(['subcategories'])
            ->find($id);

        if (!$categories) {
            return response()->json([
                'error' => 'O registro informado não existe na base de dados.'
            ], 404);
        }

        return response()->json($categories, 200);
    }
}
