<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use Exception;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    // ✅ READ
    public function index()
    {
        return response()->json(Product::all());
    }

    // ✅ CREATE (VALIDASI + SERVICE + ERROR HANDLING)
    public function store(StoreProductRequest $request)
    {
        try {
            $data = $request->validated();
            $result = $this->service->store($data);

            return response()->json([
                'status' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal simpan data'
            ]);
        }
    }

    // ✅ UPDATE
    public function update($id, StoreProductRequest $request)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }

    // ✅ DELETE
    public function destroy($id)
    {
        Product::destroy($id);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}