@auth  
<form method="POST" action="/posts/{{$post->slug}}/comments" class="bg-gray-100 p-6 rounded-xl gap-4">
  @csrf
  <header class="flex gap-4 items-center">
    <img  class="rounded-xl" src="https://i.pravatar.cc/40?u={{auth()->id()}}" alt="" width="40" height="40">
    Add a comment
  </header>
  <div class="my-4">
    <textarea name="comment" class="w-full text-sm focus:outline-none p-4" cols="30" rows="10" placeholder="Leave a comment" required ></textarea>
    @error('comment')
      <p class="text-red-500 text-xs mt-4">{{$message}}</p>
    @enderror
  </div>
  <hr>
  <div class="mt-4">
    <x-form.button text="post"/>
  </div>
</form>
@else
<a href="/login">Log in to post a commnent</a>
@endauth  