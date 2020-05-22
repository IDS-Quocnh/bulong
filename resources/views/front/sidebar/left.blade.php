<div class="col-md-3 mt-4">
    <div class="d-flex align-items-center">
        <img src="{{ auth()->user()->profile_picture }}" alt="user" class="img-circle" width="40">
        <!-- <h5 class="ml-2">{{ auth()->user()->username }}</h5> -->
        <div class="dropdown show ml-2">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ auth()->user()->username }}
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fa fa-user"></i> Edit Profile</a>
            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()"><i class="fa fa-sign-out"></i> Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </div>
    </div>

    <div class="bg-white rounded mt-2">
      <ul class="text-right list-unstyled p-2">
        <a href="/{{ auth()->user()->username }}/confessions">
          <li class="">My Confessions <span class="ml-2"><i class="fa fa-caret-right"></i></span></li>
        </a>
        <a href="{{ route('user.felt-confessions') }}">
          <li class="">My Felt Confessions <span class="ml-2"><i class="fa fa-caret-right"></i></span></li>
        </a>

        <a href="{{ route('notifications.index') }}">
          <li class="">{{ auth()->user()->unreadNotifications->count() }} Notifications <span class="ml-2"><i class="fa fa-caret-right"></i></span></li>
        </a>
      </ul>
    </div>

    <h5 class=""><strong>Categories</strong></h5>

    <div class="bg-white rounded">
      <ul class="list-unstyled p-2">
        @foreach($categories as $record)
        <a href="{{ route('confession-categories.index', $record->slug) }}">
          <li class=""><span class="mr-2">
            <img src="{{ $record->image }}" class="img img-responsive img-circle" width="15">
            </span> {{ $record->name }} <i class="fa fa-caret-right pull-right"></i>
          </li>
        </a>
        @endforeach
      </ul>
    </div>

    <h5><strong>Trending Hashtags</strong></h5>

    <div class="bg-white rounded">
      <ul class="list-unstyled p-2">
        @foreach($tags as $tag)
          <li class="">
            <a href="{{ route('tags.show', $tag->slug) }}"># {{ $tag->name }}</a>
          </li>
        @endforeach
      </ul>
    </div>
</div>
