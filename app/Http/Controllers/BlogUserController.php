<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogUserController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_active', 1)->latest()->paginate(6);
        return view('blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $blog->increment('view');
        return view('blog.show', compact('blog'));
    }
}
