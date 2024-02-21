<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{

  public $title;
  public $slug;
  public $excerpt;
  public $date;
  public $body;

  public function __construct($title, $slug, $excerpt, $date, $body)
  {
    $this->title = $title;
    $this->slug = $slug;
    $this->excerpt = $excerpt;
    $this->date = $date;
    $this->body = $body;
  }

  public static function find($slug)
  {
    // of all blog posts, find one with a slug that matches the one requested
    return static::all()->firstWhere('slug', $slug);
/*    if(! file_exists($path = resource_path("posts/{$slug}.html")))
    {
      throw new ModelNotFoundException();
    }

    // Arrow functions automatically inherit variables from the parent scope without explicitly needing the use keyword.
    return cache()->remember("posts.{$slug}", 36000, fn()=>  file_get_contents($path));
    */
    
  }

  public static function findOrFail($slug)
  {
    $posts = static::find($slug);
    if(! $posts)
    {
      throw new ModelNotFoundException();
    }
    return $posts;
  }

  public static function all()
  {
    return cache()->rememberForever('posts.all', function(){

      $files = File::files(resource_path("posts/"));
  
     /* $posts = [];
  
      $posts = array_map(function($file) {
          $document = YamlFrontMatter::parseFile($file);
  
          return new Post(
              $document->title,
              $document->slug,
              $document->excerpt,
              $document->date,
              $document->body()
          );
      }, $files);*/
  
      return collect($files)
      ->map(fn($file)=> $document = YamlFrontMatter::parseFile($file)) 
      ->map(fn($document)=> new Post(
              $document->title,
              $document->slug,
              $document->excerpt,
              $document->date,
              $document->body()
          ))
      ->sortByDesc('date');
    });

    //  return array_map(fn($file) => $file->getContents(), $files);
  }
}