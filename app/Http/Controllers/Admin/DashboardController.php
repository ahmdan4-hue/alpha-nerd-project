<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'stats' => [
                'posts'        => Post::count(),
                'categories'   => Category::count(),
                'messages'     => ContactMessage::count(),
                'deletedPosts' => Post::onlyTrashed()->count(),
            ],
            'latestPosts' => Post::with('category')->orderby('id' , 'desc')->take(5)->get(),
        ]);
    }
}
