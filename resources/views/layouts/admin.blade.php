<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend-style')
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />

    @stack('addon-style')

  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- sidebar -->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <img
              src="/images/administrator.png"
              alt="store-logo"
              class="mv-4 m-4"
              style="max-width: 100px"
            />
          </div>
          <div class="list-group list-group-flush">
            <a
              href="{{ route('admin-dashboard') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin')) ? 'active' : ''}}"
              >Dashboard</a
            >
            <a
              href="{{ route('product.index') }}"
              class="list-group-item list-group-item-action {{ (request()->is('admin/product')) ? 'active' : ''}}"
              >Product</a
            >
            <a
            href="{{ route('product-gallery.index') }}"
            class="list-group-item list-group-item-action {{ (request()->is('admin/product-gallery*')) ? 'active' : ''}}"
            >Product Gallery</a
          >
            <a
            href="{{ route('category.index') }}"
            class="list-group-item list-group-item-action {{ (request()->is('admin/category*')) ? 'active' : ''}}"
            >Categories</a
            >
            <a
              href="{{ route('transaction.index') }}"
              class="list-group-item list-group-item-action"
              >Transcactions</a
            >
            <a
            href="{{ route('user.index') }}"
            class="list-group-item list-group-item-action {{ (request()->is('admin/user*')) ? 'active' : ''}}"
            >Users</a
            >
            <a
              href="{{ url('/dashboard/settings') }}"
              class="list-group-item list-group-item-action"
              >Store Settings</a
            >
            <a
              href="{{ url('/dashboard/account') }}"
              class="list-group-item list-group-item-action"
              >My Account</a
            >
            <a href="/index.html" class="list-group-item list-group-item-action"
              >Sign Out</a
            >
          </div>
        </div>
        <!-- page content -->
        <div id="page-content-wrapper">
          <nav
          class="navbar navbar-expand-lg navbar-light navbar-store fixed-top"
          data-aos="fade-down"
          aria-label="Navbar"
        >
          <div class="container-fluid">
            <a
              type="button" 
              id="menu-toggle"
              class="btn d-md-none"><span class="bi bi-arrow-right-circle"  style="font-size: 26px; color:green"></span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">

              <!-- Desktop Menu -->
              <ul class="navbar-nav d-none d-lg-flex ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-none d-lg-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hi, {{ Auth::user()->name }}
                        <img src="/images/candra.jpg" alt="profile photo {{ Auth::user()->name }}" class="rounded-circle mr-2 profile-picture"/>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('dashboard') }}" >Dashboard</a></li>
                      <li><a class="dropdown-item" href="{{  route('dashboard-settings-account') }}">Settings</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                      </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-inline-block mt-2" href="{{ route('cart') }}">
                      @php
                        $carts = App\Models\Cart::where('users_id', Auth::user()->id)->count();
                      @endphp
                        <img src="/images/icon-cart-empty.svg" alt="" />
                        <div class="cart-badge">{{ $carts }}</div>
                    </a>
                </li>
                </ul>

              <!-- Mobile Menu -->
              <ul class="navbar-nav d-block d-lg-none">
                <li class="nav-item">
                  <a class="nav-link" href="#"> Hi, {{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('home') }}">Home </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-inline-block mt-2" href="{{ route('cart') }}">
                    @php
                      $carts = App\Models\Cart::where('users_id', Auth::user()->id)->count();
                    @endphp
                      <img src="/images/icon-cart-empty.svg" alt="" />
                      <div class="cart-badge">{{ $carts }}</div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
          
          {{-- Content --}}
          @yield('content')
          
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
     <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.8/datatables.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <!-- Menu Toggle Script -->
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    @stack('addon-script')
  </body>
</html>
