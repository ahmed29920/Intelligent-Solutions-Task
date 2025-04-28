<?php

namespace App\Services;


use App\Http\Requests\ProductRequest;
use App\Interfaces\ProductRepositoryInterface;


class ProductService
{

    protected $productRepository;

    // Inject the ProductRepositoryInterface into the constructor
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
        // images are not sent in PUT method request
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
