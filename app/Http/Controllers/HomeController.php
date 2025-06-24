<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index()
{
    $banners = Banner::where('is_active', true)->get();
    $blogs = Blog::where('is_active', true)->latest()->take(3)->get();

    return view('user.index', compact('banners', 'blogs'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.product-detail');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = DB::table('products')->where('id', $id)->first();
        return view('user.product-detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
