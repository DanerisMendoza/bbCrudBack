<?php

namespace App\Http\Controllers;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return $this->productService->getAll();
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productService->create($request->validated());

        return response()->json($product, 201);
    }

    public function show($id)
    {
        return $this->productService->findById($id);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = $this->productService->update($id, $request->validated());

        return response()->json($product);
    }

    public function destroy($id)
    {
        $this->productService->delete($id);

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
