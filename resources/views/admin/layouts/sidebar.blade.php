<aside class="left-sidebar">
<!-- Sidebar scroll-->
<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
            <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="{{ asset('admin/assets/images/users/1.jpg') }}" alt="user-img" class="img-circle"><span class="hide-menu">{{ auth()->user()->username }}</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                    <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
            <li class="nav-small-cap">--- MAIN MENU</li>
            <li> <a class="waves-effect waves-dark" href="{{ route('admin.dashboard') }}"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
            </li>

            <li> <a class="waves-effect waves-dark" href="{{ route('admin.users.index') }}"><i class="icon icon-people"></i><span class="hide-menu">Users</span></a>
            </li>

            <li> <a class="waves-effect waves-dark" href="{{ route('admin.news.index') }}"><i class="icon icon-book-open"></i><span class="hide-menu">Blogs</span></a>
            </li>

            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-bullhorn"></i><span class="hide-menu">Confession</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('admin.categories.index') }}">Category</a></li>
                    <li><a href="{{ route('admin.confessions.index') }}">Lists</a></li>
                </ul>
            </li>

            <li> <a class="waves-effect waves-dark" href="{{ route('admin.advertisements.index') }}"><i class="icon icon-star "></i><span class="hide-menu">Advertisements</span></a>
            </li>

            <li> <a class="waves-effect waves-dark" href="{{ route('admin.settings') }}"><i class="icon icon-settings"></i><span class="hide-menu">Settings</span></a>
            </li>

            <li> <a class="waves-effect waves-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-expanded="false"><i class="icon icon-logout"></i><span class="hide-menu">Log Out</span></a></li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
</aside>
