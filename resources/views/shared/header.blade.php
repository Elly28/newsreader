<header>
    <!-- Header Start -->
   <div class="header-area">
        <div class="main-header ">
            <div class="header-top black-bg d-none d-md-block">
                <div class="container">
                    <div class="col-xl-12">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="header-info-left">
                                <ul>
                                    <li><img src="{{ asset('/img/icon/header_icon1.png') }}" alt="">34ºc, Sunny </li>
                                    <li><img src="{{ asset('img/icon/header_icon1.png') }}" alt="">{{ date('l, jS F, Y') }}</li>
                                </ul>
                            </div>
                            <div class="header-info-right">
                                <ul class="header-auth d-flex align-items-center">
                                    @guest
                                        <li><a href="{{ route('login') }}" class="btn btn-primary btn-sm mr-2">Login</a></li>
                                        <li><a href="{{ route('register') }}" class="btn btn-secondary btn-sm">Sign Up</a></li>
                                    @endguest
            
                                    @auth
                                        <li style="color: white" class="mr-2">Welcome, {{ Auth::user()->name }}!</li> <!-- Display user's name -->
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                                            </form>
                                        </li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="header-mid d-none d-md-block">
               <div class="container">
                    <div class="row d-flex align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="header-banner f-right ">
                                <img src="{{ asset('/img/hero/header_card.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
               </div>
            </div>
           <div class="header-bottom header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                            <div class="main-menu d-none d-md-block">
                                <nav>                  
                                    <ul id="navigation">    
                                        <li><a href="/">Home</a></li>
                                        <li><a href="#">Category</a>
                                            <ul class="submenu">
                                                @foreach ($categories as $category)
                                                    <li><a href="{{ $category }}">{{ $category }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('contact') }}">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>             
                        <div class="col-xl-2 col-lg-2 col-md-4">
                            <div class="header-right-btn f-right d-none d-lg-block">
                                {{-- <i class="fas fa-search special-tag"></i> --}}
                                <!-- Theme Toggle Button -->
                                <div class="">
                                    <button id="theme-toggle" class="btn btn-primary">Toggle Dark Mode</button>
                                </div>
                                {{-- <div class="search-box">
                                    <form action="#">
                                        <input type="text" placeholder="Search">
                                    </form>
                                </div> --}}
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-md-none"></div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
   </div>
    <!-- Header End -->
</header>