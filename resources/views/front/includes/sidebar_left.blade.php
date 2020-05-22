<div class="w-3/12 hidden lg:block">
    <aside class="sticky top-0 h-screen overflow-y-auto left-bar">
    <div class="flex flex-col justify-center items-center">
        <img src="/public/images/profile.jpg" class="h-10 w-10 rounded-full" />
        @auth
        <h1 class="mt-1 text-gray-700 mb-1">{{ '@' . auth()->user()->username }}</h1>
        @endauth
        @guest
        <h1 class="mt-1 text-gray-700 mb-1">Guest</h1>
        @endguest
    </div>
    <personal-menu :followers-count="{{ $followersCount }}" :followings-count="{{ $followingsCount }}"></personal-menu>
    <category-list></category-list>
</aside>
</div>
