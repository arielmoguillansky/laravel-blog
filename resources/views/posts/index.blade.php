{{-- @extends('layout')
@section('content')
  <h1>POSTS</h1>
    @foreach ($posts as $post)
      <article class="{{$loop->even ? 'mb-6' : ''}}">
        <h1>
        <a href="/posts/{{$post->slug}}">
          {{ $post->title }}
        </a>  
      </h1>
      <p>By <a href="/authors/{{$post->author->username}}">{{$post->author->name}}</a> in   <a href="/categories/{{$post->category->slug}}">{{ $post->category->name }}</a></p>
        <div>
          <p>
            {{ $post->excerpt }}
          </p>
          <a href="/categories/{{$post->category->slug}}">{{ $post->category->name }}</a>
        </div>
      </article>
    @endforeach
@endsection --}}
<x-layout>
  @include('posts._header')

    @if ($posts->count())
      <x-posts-grid :posts="$posts"/>
      {{$posts->links()}}
    @else
      <p> No Posts published</p>
    @endif
</x-layout>
