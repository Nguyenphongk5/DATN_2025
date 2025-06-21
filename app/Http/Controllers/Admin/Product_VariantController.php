<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Product_VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = DB::table('products')->select('id', 'name')->get();
        $productVariants = DB::table('product_variants')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select('product_variants.*', 'products.name as product_name')
            ->paginate(10);
        return view('admin.product_variants.index', compact('productVariants', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $products = DB::table('products')->select('id', 'name')->get();
        return view('admin.product_variants.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|integer|min:0',
            'color_name' => 'required|string|max:50',
            'hex_code' => 'required|string|max:7',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0',
        ]);
        DB::table('product_variants')->insert($data);
        return redirect()->route('product_variants.index')->with('success', 'Product variant created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $productVariant = DB::table('product_variants')->where('id', $id)->first();
        if (!$productVariant) {
            return redirect()->route('product_variants.index')->with('error', 'Product variant not found.');
        }
        return view('admin.product_variants.show', compact('productVariant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $products = DB::table('products')->select('id', 'name')->get();
        $productVariant = DB::table('product_variants')->where('id', $id)->first();
        if (!$productVariant) {
            return redirect()->route('product_variants.index')->with('error', 'Product variant not found.');
        }
        return view('admin.product_variants.edit', compact('productVariant', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|integer|min:0',
            'color_name' => 'required|string|max:50',
            'hex_code' => 'required|string|max:7',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0',
        ]);
        DB::table('product_variants')->where('id', $id)->update($data);
        return redirect()->route('product_variants.index')->with('success', 'Product variant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $productVariant = DB::table('product_variants')->where('id', $id)->first();
        if (!$productVariant) {
            return redirect()->route('product_variants.index')->with('error', 'Product variant not found.');
        }
        DB::table('product_variants')->where('id', $id)->delete();
        return redirect()->route('product_variants.index')->with('success', 'Product variant deleted successfully.');
    }
}
