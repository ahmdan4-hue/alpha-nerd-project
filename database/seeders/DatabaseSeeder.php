<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\ContactMessage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@alphanerd.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'is_admin' => 1,
            ]
        );

        $user = User::updateOrCreate(
            ['email' => 'user@alphanerd.test'],
            [
                'name' => 'Ahmed',
                'password' => Hash::make('password123'),
                'is_admin' => 0,
            ]
        );

        $categories = ['general', 'cyber', 'tools'];

        foreach ($categories as $name) {
            Category::updateOrCreate(
                ['name' => $name],
                ['name' => $name]
            );
        }

        $postsCount = 15;

        $basePosts = [
            [
                'title' => 'Beginner roadmap: learning security the right way',
                'content' => "Starting in cybersecurity can feel confusing at first, so I prefer a simple roadmap. Begin with networking, operating systems, and Linux basics. After that, move to security foundations and hands-on labs. The most important thing is to build real practice step by step instead of jumping randomly between tools.",
                'category' => 'cyber',
                'image' => 'uploads/posts/1.jpg',
            ],
            [
                'title' => 'My top tools list (and why I actually use them)',
                'content' => "I like keeping my toolkit simple and useful. A terminal, good notes app, browser extensions, and a Linux environment already cover a lot. The goal is not to collect tools, but to understand why each one is useful and when to use it in real work.",
                'category' => 'tools',
                'image' => 'uploads/posts/2.jpg',
            ],
            [
                'title' => 'My setup for staying focused while studying',
                'content' => "When I study, I try to reduce distractions as much as possible. I keep a clean task list, study in short focused sessions, and review what I finished at the end of the week. Small habits make a big difference when the goal is steady progress.",
                'category' => 'general',
                'image' => 'uploads/posts/3.jpg',
            ],
        ];

        $createdPosts = [];

        foreach ($basePosts as $item) {
            $category = Category::where('name', $item['category'])->first();

            $post = Post::updateOrCreate(
                ['title' => $item['title']],
                [
                    'content' => $item['content'],
                    'category_id' => $category?->id,
                    'user_id' => $admin->id,
                    'image' => $item['image'],
                ]
            );

            $createdPosts[] = $post;
        }

        $this->seedExtraPosts($postsCount, $admin->id, $createdPosts);

        foreach (array_slice($createdPosts, 0, 2) as $post) {
            Comment::firstOrCreate(
                [
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                    'content' => 'First comment (seed) ✅',
                ]
            );

            Comment::firstOrCreate(
                [
                    'post_id' => $post->id,
                    'user_id' => $admin->id,
                    'content' => 'Admin reply (seed) ✅',
                ]
            );
        }

        ContactMessage::firstOrCreate(
            [
                'email' => 'test@example.com',
                'subject' => 'Hello from seeder',
            ],
            [
                'name' => 'Test User',
                'message' => 'This is a seeded contact message.',
            ]
        );
    }

    private function seedExtraPosts(int $postsCount, int $adminId, array &$createdPosts): void
    {
        $categories = Category::pluck('id', 'name')->toArray();

        $categoryCycle = ['cyber', 'tools', 'general'];
        $imageCycle = [
            'uploads/posts/1.jpg',
            'uploads/posts/2.jpg',
            'uploads/posts/3.jpg',
        ];

        $baseCount = 3;

        if ($postsCount <= $baseCount) {
            return;
        }

        for ($i = $baseCount + 1; $i <= $postsCount; $i++) {
            $categoryName = $categoryCycle[($i - 1) % count($categoryCycle)];
            $imagePath = $imageCycle[($i - 1) % count($imageCycle)];

            $post = Post::updateOrCreate(
                ['title' => 'post' . $i],
                [
                    'content' => 'This is seeded post number ' . $i . ' for testing pagination.',
                    'category_id' => $categories[$categoryName] ?? null,
                    'user_id' => $adminId,
                    'image' => $imagePath,
                ]
            );

            $createdPosts[] = $post;
        }
    }
}
