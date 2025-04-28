<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    // Define the methods that the ProductRepository should implement
    public function index(array $filters);
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
    public function changeStatus($id,$status);
}
