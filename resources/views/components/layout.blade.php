<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
  {{-- @yield('content') This is an alternative to slots --}}
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                @guest
                    <a href="/register" class="text-xs font-bold uppercase">Register</a>
                    <a href="/login" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">Login</a>
                @endguest
                @auth
                <x-dropdown>
                    <x-slot name="trigger">
                        <span class="mr-4 cursor-pointer">Welcome, {{auth()->user()->name}}</span>
                    </x-slot>
                    <x-dropdown-item href="/">Dashboard</x-dropdown-item>
                    {{-- @if (auth()->user()->can('admin'))
                        <x-dropdown-item href="/admin/posts/create">New post</x-dropdown-item>
                        <x-dropdown-item href="/admin/posts">Manage posts</x-dropdown-item>
                    @endif --}}
                    {{-- The admin is a blade directive that can be built in the AppServiceProvider--}}
                    {{-- @admin
                        <x-dropdown-item href="/admin/posts/create">New post</x-dropdown-item>
                        <x-dropdown-item href="/admin/posts">Manage posts</x-dropdown-item>
                    @endadmin --}}
                    {{-- Alternative to show links only for administrator. The name 'admin' cames from the Gate method in the AppServiceProvider --}}
                    @can ('admin')
                        <x-dropdown-item href="/admin/posts/create">New post</x-dropdown-item>
                        <x-dropdown-item href="/admin/posts">Manage posts</x-dropdown-item>
                    @endcan
                    <x-dropdown-item href="/logout" x-data="{}" @click.prevent="document.querySelector('#logout-form').submit()">Log Out</x-dropdown-item>
                </x-dropdown>
                <form action="/logout" method="post" class="hidden" id="logout-form">
                    @csrf
                </form>
                @endauth

                <a href="#newsletter" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscribe for Updates
                </a>
            </div>
        </nav>
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">         
            {{$slot}}
        </main>

        <footer class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16" id="newsletter">
            <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
            <h5 class="text-3xl">Stay in touch with the latest posts</h5>
            <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                    <form method="POST" action="/newsletter" class="lg:flex text-sm">
                        @csrf
                        <div class="lg:py-3 lg:px-5 flex items-center">
                            <label for="email" class="hidden lg:inline-block">
                                <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <input id="email" type="text" name="email" placeholder="Your email address"
                                   class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                        </div>

                        <x-form.button text="subscribe"/>
                    </form>
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-4">{{$message}}</p>
                @enderror
            </div>
        </footer>
    </section>

    @if (session()->has('success'))
    <div x-data="{show:true}" x-init="setTimeout(()=>show = false, 4000)" x-show="show">
      <p class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">{{session()->get('success')}}</p>
    </div>
    @endif


</body>
