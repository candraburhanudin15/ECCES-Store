<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
        <img src="/images/logo.svg" alt="" />
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories') }}">Categories</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Rewards</a>
                  </li>
                  @guest              
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="btn btn-success px-4 text-white d-block"
                      href="{{ route('login') }}"
                      >Sign In <span><i class="bi bi-door-open"></i></span></a>
                  </li>
                  @endguest
            </ul>
            @auth
            <!-- Desktop Menu -->
            <ul class="navbar-nav">
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
               
                    <img src="/images/icon-cart-empty.svg" alt="cart-img" />
                    <div class="cart-badge">{{ $carts }}</div>
                </a>
            </li>
            </ul>
            
            <!-- Mobile Menu -->
            <ul class="navbar-nav d-block d-lg-none">
                {{-- <li class="nav-item">
                  <a class="nav-link" href="#"> Hi, {{ Auth::user()->name }} </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-inline-block" href="{{ route('cart') }}"> Cart </a>
                </li> --}}
                <li><a class="dropdown-item bg-black text-white rounded-3 p-2 text-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}, {{ Auth::user()->name }}</a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                   @csrf
               </form>
               </li>
              </ul>
        </div>
        </div>
        @endauth
  </nav>





