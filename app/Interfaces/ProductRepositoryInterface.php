<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function index(array $filters);
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
    public function changeStatus($id,$status);
}
