<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Tạo một sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric'
        ]);

        $product = Product::create($request->all());

        return response()->json($product, Response::HTTP_CREATED);
    }

    // Lấy một sản phẩm theo ID
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($product);
    }

    // Cập nhật thông tin sản phẩm
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric'
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], Response::HTTP_NOT_FOUND);
        }

        $product->update($request->all());

        return response()->json($product);
    }

    // Xóa một sản phẩm
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], Response::HTTP_NOT_FOUND);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted.'], Response::HTTP_OK);
    }

}
