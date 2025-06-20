<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brands = DB::table('brands')->paginate(10);
        return view('admin.brands.index', compact('brands'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('brands', 'public');
        }
        DB::table('brands')->insert($data);
        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //'
        $brand = DB::table('brands')->where('id', $brand->id)->first();
        if (!$brand) {
            return redirect()->route('brands.index')->with('error', 'Brand not found.');
        }
        return view('admin.brands.detail', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
        $brand = DB::table('brands')->where('id', $brand->id)->first();
        if (!$brand) {
            return redirect()->route('brands.index')->with('error', 'Brand not found.');
        }
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug,' . $brand->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('brands', 'public');
            // unset($data['logo']); // Remove logo from data if not uploaded
        }else {
             $data['logo'] = DB::table('brands')->where('id', $brand->id)->value('logo');
        }
        DB::table('brands')->where('id', $brand->id)->update($data);
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
