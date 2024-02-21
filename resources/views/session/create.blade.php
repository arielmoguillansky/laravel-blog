<x-layout>
  <section>
    <h1 class="text-center text-4xl font-bold">Register</h1>
    <form action="/login" method="POST">
      @csrf
      <div class="mb-6">
        <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">email</label>
        <input type="email" name="email" class="border border-gray-400 p-2 w-full" value="{{old('email')}}">
        @error('email')
        <p class="text-red-500 text-xs mt-4">{{$message}}</p>
      @enderror
      </div>
      <div class="mb-6">
        <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">password</label>
        <input type="password" name="password" class="border border-gray-400 p-2 w-full">
        @error('password')
        <p class="text-red-500 text-xs mt-4">{{$message}}</p>
      @enderror
      </div>
      <div class="">
        <x-form.button text="log in"/>
      </div>
      @if ($errors->any())
        <ul>
          @foreach ($errors->all() as $error )
            <li>{{$error}}</li>
          @endforeach
        </ul>
      @endif
    </form>

  </section>
</x-layout>
