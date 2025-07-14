<header class="header-area header-two transparent-header">
    <!--====== Header Navigation ======-->
    <div class="header-navigation navigation-white">
        <div class="nav-overlay"></div>
        <div class="container-fluid">
            <div class="primary-menu">
                <!--====== Site Branding ======-->
                <div class="site-branding">
                    <a href="index.html" class="brand-logo"><img
                            src="{{ asset('user_assets/images/logo/logo_white.svg') }}" alt="Site Logo"></a>
                </div>
                <!--====== Nav Menu ======-->
                <div class="nav-menu">
                    <!--====== Site Branding ======-->
                    <div class="mobile-logo mb-30 d-block d-xl-none">
                        <a href="index.html" class="brand-logo"><img
                                src="{{ asset('user_assets/images/logo/logo-black.png') }}" alt="Site Logo"></a>
                    </div>
                    <!--====== Main Menu ======-->
                    <nav class="main-menu">
                        <ul>
                            <li class="menu-item has-children"><a href="{{ route('main.index') }}">Beranda</a></li>
                            <li class="menu-item has-children"><a href="{{ route('main.trip') }}">Paket Trip</a></li>
                            <li class="menu-item has-children"><a href="{{ route('main.tutorial') }}">Cara Booking</a>
                            </li>
                            <li class="menu-item has-children"><a href="{{ route('main.about') }}">Tentang Kami</a></li>
                            <li class="menu-item has-children"><a href="{{ route('main.artikel') }}">Artikel</a></li>

                        </ul>
                    </nav>
                    <!--====== Menu Button ======-->
                    <div class="menu-button mt-40 d-xl-none">
                        <a href="contact.html" class="main-btn secondary-btn">Chat Admin<i
                                class="fas fa-paper-plane"></i></a>
                    </div>
                </div>
                <!--====== Nav Right Item ======-->
                <div class="nav-right-item">
                    <nav class="main-menu">
                        <ul>
                            @guest
                                <!-- Jika belum login -->
                                <li class="menu-item"><a href="{{ url('/auth/google') }}">Masuk</a></li>
                            @else
                                <!-- Jika sudah login -->
                                <li class="menu-item">
                                    <a href="#">
                                        @if (Auth::user()->avatar)
                                            <img src="{{ Auth::user()->avatar }}" alt="Avatar"
                                                style="width: 32px; height: 32px; border-radius: 50%;">
                                        @else
                                            <div
                                                style="width: 50px; height: 50px; border-radius: 50%; background-color: #000000; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px;">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </a>
                                    <ul class="sub-menu">
                                        @if (Auth::user()->role == 'admin')
                                            <li><a href="{{ route('admin.dashboard.index') }}">Dashboard Saya</a></li>
                                        @endif
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Keluar
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                    </nav>
                    <div class="menu-button d-xl-block d-none">
                        <a href="contact.html" class="main-btn primary-btn">Chat Admin<i
                                class="fas fa-paper-plane"></i></a>
                    </div>
                    <div class="navbar-toggler">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header><!--====== End Header ======-->
