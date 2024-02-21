<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Post::factory(3)->create(); // this will create a user and a category as well.
        Comment::factory(3)->create(['post_id'=> 1]);

        // $sports = Category::create([
        //     'name' => 'Sports',
        //     'slug' => 'sports'
        // ]);


        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $sports->id,
        //     'title' => 'First post',
        //     'slug' => 'first-post',
        //     'excerpt' => 'first-post',
        //     'body' => 'first-post',
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
