<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $blogs = DB::table('blogs')
            ->join('users', 'blogs.user_id', '=', 'users.id')
            ->select('blogs.*', 'users.name as author_name')
            ->paginate(10);
        $users = DB::table('users')->select('id', 'name')->get();
        return view('admin.blogs.index', compact('blogs', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'img_avt' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'short_description' => 'nullable|string|max:500',
            'content' => 'required|string',
        ]);
        if ($request->hasFile('img_avt')) {
            $data['img_avt'] = $request->file('img_avt')->store('blog_images', 'public');
        } else {
            $data['img_avt'] = null;
        }
        $data['user_id'] = Auth::id(); // lấy ID người dùng hiện tại
        DB::table('blogs')->insert($data);
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $blog = DB::table('blogs')
        ->join('users', 'blogs.user_id', '=', 'users.id')
        ->select('blogs.*', 'users.name as author_name')
        ->where('blogs.id', $id)->first();
        if(!$blog){
            return redirect()->route('blogs.index')->with('error', 'Blog not found.');
        }
        return view('admin.blogs.detail', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $blog = DB::table('blogs')->where('id', $id)->first();
        if (!$blog) {
            return redirect()->route('blogs.index')->with('error', 'Blog not found.');
        }
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $id,
            'img_avt' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'short_description' => 'nullable|string|max:500',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);
        if ($request->hasFile('img_avt')) {
            $data['img_avt'] = $request->file('img_avt')->store('blog_images', 'public');
        } else {
            $data['img_avt'] = DB::table('blogs')->where('id', $id)->value('img_avt');
        }
        DB::table('blogs')->where('id', $id)->update($data);
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
