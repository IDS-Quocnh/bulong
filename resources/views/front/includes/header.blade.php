<header class="flex justify-between items-center pt-1 lg:px-32 border">
    <div>
        <a href="/">
            <img src="/images/logo.png" class="w-32" />
        </a>
    </div>
    <div class="hidden lg:block">
        <form method="GET" action="{{ route('search') }}">
            <input type="text" name="q" placeholder="&#128269; Search..." class="p-2 lg:text-sm text-center border" value="{{ $query ?? '' }}" />
        </form>
    </div>
    @auth
    <div class="flex items-center text-gray-600">
        <a href="/">
            <span class="text-xl text-white mr-3 bg-gray-600 h-8 w-8 flex justify-center items-center rounded-full"><i class="fa fa-home "></i></span>
        </a>
        <a href="/notifications">
            <div class="text-3xl relative inline"><i class="fa fa-bell-o"></i>
                <span class="absolute t-0 r-0 -ml-4 mt-2 bg-gray-600 h-4 w-4 rounded-full text-xs text-center text-white">{{ auth()->user()->unreadNotifications->count() }}</span>
            </div>
        </a>
        <div class="dropdown relative inline-block">
            <img src="/public/images/profile.jpg" class="h-10 w-10 rounded-full mx-3 ">
            <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
              <li class=""><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-6 block whitespace-no-wrap" href="#">Edit profile</a></li>
              <li class=""><a class="bg-gray-200 hover:bg-gray-400 py-2 px-6 block whitespace-no-wrap" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a></li>
            </ul>
        </div>
    </div>
    @endauth
    @guest
    <div>
        <a href="/login">
            <button class="px-5 mr-2 text-sm text-center rounded border-2 border-blue-400">Log in</button>
        </a>
        <a href="/signup">
            <button class="px-5 text-sm text-center text-white rounded  border-2 border-blue-400 bg-blue-400">SIGN UP</button>
        </a>
    </div>
    @endguest
</header>
