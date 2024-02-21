<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    // protected $fillable = ['body', 'user_id']; // an alternative to avoid creating fillables or guarded is configuring the AppServiceProvider::boot

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id'); // the user_id is because the function name is different -author-
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
