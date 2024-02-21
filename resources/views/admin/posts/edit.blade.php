<x-layout>
  <h1>Edit post</h1>
  <h2>{{$post->title}}</h2>
  <form action="/admin/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <x-form.input name="title" :value="old('title',$post->title)"/>
    <x-form.input name="slug" :value="old('slug',$post->slug)"/>
      <div class="flex gap-4">
         <x-form.input name="thumbnail" type="file"/>
          <img src="{{asset("storage/".$post->thumbnail)}}" alt="" class="rounded-xl">
        </div>
    <x-form.textarea name="excerpt">{{old('excerpt',$post->excerpt)}}</x-form.textarea>
    <x-form.textarea name="body">{{old('body',$post->body)}}</x-form.textarea>
    <x-form.select name="category_id">
      @php
        $categories = \App\Models\Category::all();
      @endphp
      <option selected disabled>Select category...</option>
      @foreach ($categories as $category )
        <option value="{{$category->id}}" {{old('category_id', $post->category->id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
      @endforeach
    </x-form.select>
    <hr class="my-4">
    <x-form.button text="publish"/>
  </form>
</x-layout>