<?php
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AdminPostController;
use App\Services\Newsletter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('newsletter', [NewsletterController::class, '__invoke']);


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/posts', function () {

//     // \Illuminate\Support\Facades\DB::listen(function($query) {
//     //     logger($query->sql, $query->bindings);
//     // });

//     // $posts = Post::all();
//     // $posts = Post::latest()->with('category', 'author')->get(); // Select all posts with category. This resolves the N+1 issue. Instead of making one query for each category, it only does one with all.
    


// })->name('posts');
Route::get('/posts', [PostController::class, 'index'])->name('posts')->middleware('auth');

Route::get('/posts/{post}',[PostController::class, 'show']);
Route::post('/posts/{post}/comments',[CommentController::class, 'store']);

// Route::get('/posts/{post}', function (Post $post) {
// // Route::get('/posts/{post:slug}', function (Post $post) { //This option is used when no getRouteKeyName is specified in the Model.
//     /*$path = __DIR__ . "/../resources/posts/{$slug}.html";
//     if(! file_exists($path))
//     {
//         // ddd('File does not exist');
//         // dd('File does not exist');
//         // abort(404);
//         return redirect('/posts');
//     }

//     // The use ($path) statement is necessary because the anonymous function has its own scope, and it needs to access the value of the $path variable from the outer scope. Without use ($path), the anonymous function wouldn't "see" the $path variable, and you would encounter an error or unexpected behavior.

//     // $post = cache()->remember("posts.{$slug}", 36000, function() use ($path) {
//     //      return file_get_contents($path);
//     // });

//     // Arrow functions automatically inherit variables from the parent scope without explicitly needing the use keyword.
//     $post = cache()->remember("posts.{$slug}", 36000, fn()=>  file_get_contents($path));
//     */
    
//     // Find a post by its slug and pass it to the view

//     // return view('post', [
//     //     'post' => Post::findOrFail($id)
//     // ]);

//     // Route - model binding. The variable name must match the slug wildcard name
//     return view('post', [
//         'post' => $post
//     ]);
// });
// })->where('post', '[A-z0-9_\-]+');

Route::get('/json', function () {
    return ["foo" => "bar"];
});

Route::get('categories/{category:slug}', function(Category $category) {
    // return view('posts', ['posts' => $category->posts->load(['category', 'author'])]);
    return view('posts.index', ['posts' => $category->posts, 'categories' => Category::all(), 'currentCategory' => $category]);
})->name('category');

Route::get('authors/{author:username}', function(User $author) {
    return view('posts.index', ['posts' => $author->posts]);
});

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');// only guests or users that are not signed in can view the register page
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->name('login');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');
Route::post('admin/post', [AdminPostController::class, 'store'])->middleware('admin');
Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('admin');
Route::get('admin/posts/{post:id}/edit', [AdminPostController::class, 'edit'])->middleware('admin');
Route::patch('admin/posts/{post:id}', [AdminPostController::class, 'update'])->middleware('admin');
Route::delete('admin/posts/{post:id}', [AdminPostController::class, 'delete'])->middleware('admin');
Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('admin');