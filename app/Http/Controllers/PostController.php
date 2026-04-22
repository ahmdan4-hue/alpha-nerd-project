<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function deleted()
    {
        $posts = Post::with('category')->onlyTrashed()->latest('deleted_at')->paginate(10);
        return view('admin.posts.deleted', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/posts'), $filename);
            $data['image'] = 'uploads/posts/' . $filename;
        }

        $data['user_id'] = Auth::id();

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post created ✅');
    }

    public function show(Post $post)
    {
        return redirect()->route('posts.show', $post);
    }

    public function showDeleted($id)
    {
        $post = Post::with('category')->onlyTrashed()->findOrFail($id);
        return view('admin.posts.deleted-show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/posts'), $filename);
            $data['image'] = 'uploads/posts/' . $filename;
        } else {
            unset($data['image']);
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated ✅');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post moved to deleted posts ✅');
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('admin.posts.deleted')->with('success', 'Post restored ✅');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }

        $post->forceDelete();

        return redirect()->route('admin.posts.deleted')->with('success', 'Post permanently deleted ✅');
    }
}
