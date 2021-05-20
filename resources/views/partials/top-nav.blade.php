<a href="{{ route('homepage') }}" class="navbar-brand sidebar-gone-hide">Shop</a>
<a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
<div class="nav-collapse">
    <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
        <i class="fas fa-ellipsis-v"></i>
    </a>
    <ul class="navbar-nav">
        <li class="nav-item"><a href="{{ route('homepage') }}" class="nav-link">Home</a></li>
        @auth
            <li class="nav-item"><a href="{{ route('redirector') }}" class="nav-link">Dashboard</a></li>
        @endauth
    </ul>
</div>
<div class="ml-auto"></div>
<ul class="navbar-nav navbar-right">
    {{--  Cart  --}}
    <li class="dropdown dropdown-list-toggle mr-4">
        <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i class="fa fa-shopping-cart"></i></a>
        <livewire:navbar-cart/>
    </li>
    @auth
    <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ Auth::user()->profile_photo_url }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">{{ Auth::user()->roles()->first() ? Auth::user()->roles()->first()->name : 'Member' }}</div>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item has-icon text-danger" onclick="$('#logout-form').submit()">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form action="{{ route('logout') }}" method="post" id="logout-form">
                @csrf
            </form>
        </div>
    </li>
    @else
        <a href="{{ route('login') }}" class="btn btn-outline-white">Login</a>
    @endauth
</ul>
