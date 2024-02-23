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
            <a href="{{ route('home') }}">
              <img
                src="/images/dashboard-store-logo.svg"
                alt="store-logo"
                class="mv-4 m-4"
              />
            </a>
          </div>
          <div class="list-group list-group-flush">
            <a
              href="{{ route('dashboard') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard')) ? 'active' : ''}}"
              ><span class="me-2"><i class="bi bi-house-gear"></i></span>Dashboard</a
            >
            <a
              href="{{ route('dashboard-product') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/product*')) ? 'active' : ''}}"
              ><span class="me-2"><i class="bi bi-dropbox"></i></span>My Product</a
            >
            <a
              href="{{ route('dashboard-transactions') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/transactions*')) ? 'active' : ''}}"
              ><span class="me-2"><i class="bi bi-currency-dollar"></i></span>Transcactions</a
            >
            <a
              href="{{ route('dashboard-settings-store') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/settings*')) ? 'active' : ''}}"
              ><span class="me-2"><i class="bi bi-gear"></i></span>Store Settings</a
            >
            <a
              href="{{ route('dashboard-settings-account') }}"
              class="list-group-item list-group-item-action {{ (request()->is('dashboard/account*')) ? 'active' : ''}}"
              ><span class="me-2"><i class="bi bi-person-badge"></i></span>My Account</a
            >
            <a class="list-group-item list-group-item-action" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <span class="me-2"><i class="bi bi-door-open"></i></span>{{ __('Sign out') }}, {{ Auth::user()->name }}</a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
               @csrf
           </form>
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
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
