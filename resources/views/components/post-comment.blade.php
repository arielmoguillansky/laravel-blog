@props(['comment'])
<article class="flex bg-gray-100 p-6 rounded-xl gap-4">
  <div class="flex-shrink-0">
    <img  class="rounded-xl" src="https://i.pravatar.cc/60?u={{$comment->user_id}}" alt="" width="60" height="60">
  </div>
  <div>
    <header class="mb-4">
      <h3 class="font-bold">{{$comment->author->username}}</h3>
      <p>{{$comment->created_at->format('F j, Y, g:i a')}}</p>
    </header>
    <p>{{$comment->body}}</p>
  </div>
</article>