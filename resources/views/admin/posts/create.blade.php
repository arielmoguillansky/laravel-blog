<x-layout>
  <h1>New post</h1>
  <form action="/admin/posts" method="POST" enctype="multipart/form-data">
    @csrf
    <x-form.input name="title"/>
    <x-form.input name="slug"/>
    <x-form.input name="thumbnail" type="file"/>
    <x-form.textarea name="excerpt"/>
    <x-form.textarea name="body"/>
    <x-form.select name="category_id">
      @php
        $categories = \App\Models\Category::all();
      @endphp
      <option selected disabled>Select category...</option>
      @foreach ($categories as $category )
        <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
      @endforeach
    </x-form.select>
    <hr class="my-4">
    <x-form.button text="publish"/>
  </form>
</x-layout>