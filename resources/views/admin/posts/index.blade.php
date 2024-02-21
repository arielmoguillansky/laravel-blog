<x-layout>
  <h1>Manage posts</h1>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          {{-- <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Name
              </th>
            </tr>
          </thead> --}}
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($posts as $post)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="text-sm font-medium text-gray-900">
                    {{$post->title}}
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inli-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    NAME
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <a href="/posts/{{$post->slug}}" class="text-blue-500 hover:text-blue-900">
                    View
                </a>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <a href="/admin/posts/edit/{{$post->id}}" class="text-blue-500 hover:text-blue-900">
                    Edit
                </a>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <form action="/admin/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('DELETE')
                  <x-form.button text="delete"/>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-layout>