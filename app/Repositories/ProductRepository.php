<?php

namespace App\Repositories;

use App\Models\Product;


class ProductRepository implements ProductRepositoryInterface
{
    public function index($filters)
    {
        $query = Product::query();

        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        return $query->paginate(10);
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->find($id);
        if ($product) {
            $product->update($data);
        }
        return $product;
    }

    public function delete($id)
    {
        $product = $this->find($id);
        return $product ? $product->delete() : false;
    }

    public function changeStatus($id, $status)
    {
        $product = $this->find($id);
        $product->status = $status;
        $product->save();
        return $product;
    }
}
