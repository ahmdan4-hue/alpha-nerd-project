<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(12);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:80|unique:categories,name',
        ]);

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created ✅');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:80|unique:categories,name,' . $category->id,
        ]);

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated ✅');
    }

    public function destroy(Category $category)
    {
        if ($category->posts()->exists()) {
            return back()->with('success', 'Cannot delete: category has posts ⚠️');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category moved to deleted categories ✅');
    }

    public function deleted()
    {
        $categories = Category::onlyTrashed()->latest('deleted_at')->paginate(10);
        return view('admin.categories.deleted', compact('categories'));
    }

    public function showDeleted($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        return view('admin.categories.deleted-show', compact('category'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.deleted')->with('success', 'Category restored ✅');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('admin.categories.deleted')->with('success', 'Category permanently deleted ✅');
    }
}
