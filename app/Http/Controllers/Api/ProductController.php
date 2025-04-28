<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get all products with optional filters
        $filters = $request->only(['name', 'status', 'min_price', 'max_price']);

        // Validate filters
        $products = $this->productService->getAllProducts($filters);

        // return response()->json($products, 200);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productService->createProduct($request);
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        return new ProductResource($product);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update($id, ProductRequest $request)
    {
        $product = $this->productService->updateProduct($id, $request);
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->productService->deleteProduct($id);
            return response()->json(['message' => 'Product deleted successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }
    /**
     * Change the status of the specified resource.
     */
    public function changeStatus($id)
    {
        $status = request('status');
        if (!in_array($status, ['Active', 'Inactive'])) {
            return response()->json(['error' => 'Invalid status value.'], 400);
        }

        try {
            $product = $this->productService->changeProductStatus($id, $status);
            return response()->json(['message' => 'Product status updated successfully.', 'product' => $product], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }

}
