<div class="container">
    <nav class="navbar navbar-expand-lg navbar-white">
        <a class="navbar-brand order-1" href="/">
            <img class="img-fluid" width="100px" src="/themes/clients/images/logo1.png"
                alt="Reader | Hugo Personal Blog Template">
        </a>
        <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="/" role="button">
                        Trang chủ
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="/" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        Về chúng tôi
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Liên hệ</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">Tin tức <i class="ti-angle-down ml-1"></i>
                    </a>
                    <div class="dropdown-menu">

                        @foreach ($categories as $category)
                            <a class="dropdown-item"
                                href="{{ route('categories', $category->id) }}">{{ $category->name }}</a>
                        @endforeach

                    </div>
                </li>

            </ul>
        </div>

        <div class="order-2 order-lg-3 d-flex align-items-center">

            <!-- search -->
            <form action="{{ route('news.filter') }}" class="search-bar">
                <input id="search-query" name="search" type="search" placeholder="Type & Hit Enter...">
            </form>


            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @if (Auth::user()->type == 'member')
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Đăng xuất') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Đăng xuất') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="{{ route('admin') }}">
                                    {{ __('Bảng điều khiển') }}
                                </a>
                            </div>
                        </li>
                    @endif

                @endguest
            </ul>
        </div>

    </nav>
</div>
