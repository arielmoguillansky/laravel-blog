<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'excerpt', 'body', 'slug', 'category_id', 'user_id', 'thumbnail'];

    protected $with = ['category', 'author']; // Bring Post with its category and author. This gets rid of the with([]) fn placed on the routes.

    // protected $guarded = ['id']; // everything can be mass assigned but what is specified in the guarded variable. Use either fillable or guarded but no both.

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, fn ($query, $search)=>
            $query->where(fn($query)=> 
            $query->where('title', 'like', '%'.$search.'%')->orWhere('body', 'like', '%'.$search.'%')
            )
        );

        // Bring posts with category given on search query
        // $query->when($filters['category'] ?? false, function ($query, $category){
        //     $query->whereExists(fn($query)=> $query->from('categories')->whereColumn('categories.id' , 'posts.category_id')->where('categories.slug', $category));
        // });

        // Elocuent alternative
        $query->when($filters['category'] ?? false, function ($query, $category){
            $query->whereHas('category', fn($query)=>$query->where('slug', $category));
        });

        $query->when($filters['author'] ?? false, function ($query, $author){
            $query->whereHas('author', fn($query)=>$query->where('username', $author));
        });
    }

    // This return the key name of the attribute to use to find a Post. Using this, in the route we dont specify {post:slug}, just {post}
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Elocuent relationship. hasOne, hasMany, belongsTo, belongsToMany
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function author()// changed the key name from user to author. By doing this, a new para in the belongsTo must be added which is the foreign key that is linked
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
