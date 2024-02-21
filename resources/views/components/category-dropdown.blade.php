<x-dropdown>
  <x-slot name="trigger">
      <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-56 text-left lg:inline-flex">
          {{isset($currentCategory) ? $currentCategory->name : 'Categories'}}
          
          <x-arrow-icon/>
      </button>
  </x-slot>
  {{-- <a href="/posts" class="block text-left px-3 text-sm leading-5 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white">All</a> --}}
  <x-dropdown-item href="/posts/?{{http_build_query(request()->except('category', 'page'))}}" :active="request()->routeIs('posts')">All</x-dropdown-item>
  @foreach ($categories as $category )
      {{-- <x-dropdown-item href="/categories/{{$category->slug}}" :active="isset($currentCategory) && $currentCategory->id == $category->id"> --}}
      {{-- <x-dropdown-item href="/categories/{{$category->slug}}" :active='request()->is("categories/{$category->slug}")'> --}}
      <x-dropdown-item href="/posts/?category={{$category->slug}}&{{http_build_query(request()->except('category', 'page'))}}" :active='request()->is("categories/{$category->slug}")'>
          {{$category->slug}}
      </x-dropdown-item>
  @endforeach
</x-dropdown>