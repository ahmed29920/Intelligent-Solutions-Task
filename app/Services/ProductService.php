<?php

namespace App\Services;


use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepositoryInterface;


class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function getAllProducts($filters)
    {
        return $this->productRepository->index($filters);
    }

    public function createProduct(ProductRequest $request)
    {

        $data = $request->validated();
        // Ensure images is an array if provided
        if (isset($data['images']) && is_array($data['images'])) {
            $imagePaths = [];
            foreach ($data['images'] as $image) {
                $imagePath = $image->store('products', 'public');
                $imagePaths[] = $imagePath;
            }
            $data['images'] = $imagePaths;
        }

        return $this->productRepository->create($data);
    }

    public function getProductById($id)
    {
        return $this->productRepository->find($id);
    }

    public function updateProduct($id, ProductRequest $request)
    {
        $data = $request->validated();

        // Ensure images is an array if provided
        if (isset($data['images']) && is_array($data['images'])) {
            $imagePaths = [];
            foreach ($data['images'] as $image) {
                $imagePath = $image->store('products', 'public');
                $imagePaths[] = $imagePath;
            }
            // Convert the array of image paths to a JSON string
            $data['images'] = json_encode($imagePaths);
        }

        return $this->productRepository->update($id, $data);
    }

    public function changeProductStatus($id, $status)
    {
        return $this->productRepository->changeStatus($id, $status);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }
}
