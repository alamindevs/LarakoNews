<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="@yield('author',$seo->author)">
    <meta name="keywords" content="@yield('keywords',$seo->keywords)"/>
    <meta name="description" content="@yield('description',$seo->description)">

    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="{{$seo->title}}"/>
    <meta property="og:type" content="@yield('site_type','website')"/>
    <meta property="og:title" content="@yield('title','$seo->title')"/>
    <meta property="og:description" content="@yield('description',$seo->description)"/>
    <meta property="og:url" content="@yield('url',route('index'))"/>
    @yield('image')
    @yield('tag')
    <meta name="twitter:card" content=summary/>
    <meta name="twitter:title" content="@yield('title','$seo->title')"/>
    <meta name="twitter:description" content="@yield('description',$seo->description)"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $seo->title )</title>

    <link rel="shortcut icon" href="{{$logo->logo}}" type="image/x-icon">
    <link rel="icon" href="{{$logo->logo}}" type="image/x-icon">
    <!-- Core Bootstrap File -->
    <link href="{{asset('content/website')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- ANIMATE CSS -->
    <link href="{{asset('content/website')}}/css/animate.min.css" rel="stylesheet" type="text/css">
    <!-- ZERO GRID CSS -->
    <link href="{{asset('content/website')}}/css/zerogrid.css" rel="stylesheet" type="text/css">
    <!-- Mega Menu -->
    <link rel="stylesheet" href="{{asset('content/website')}}/css/megaMenu.css">
    <!-- Font Awesome Icons -->
    <link href="{{asset('content/website')}}/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('content/website')}}/css/themify-icons.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <!-- Owl Slider Css -->
    <link href="{{asset('content/website')}}/css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="{{asset('content/website')}}/css/owl.theme.default.css" rel="stylesheet" type="text/css">
    <!-- Template Core Css -->
    <link href="{{asset('content/website')}}/css/style.css" rel="stylesheet" type="text/css">
    <link href="{{asset('content/website')}}/css/breakingNews.css" rel="stylesheet" type="text/css">
    <link href="{{asset('content/website')}}/css/magnific-popup.css" rel="stylesheet">

</head>
<!-- Body -->

<body>
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div>
    </div>
    <section class="topbar">
        <div class="container-flude">
            <div class="row">
                <div class="col-ms-12 col-sm-12 col-xs-12">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <div class="news-ticker-block">
                            <div class="breakingNews" id="bn4">
                                <div class="bn-title">
                                    <h2>Breaking News</h2>
                                    <span></span>
                                </div>
                                <ul>
                                  @foreach($topnews as $data)

                                    <li><a href="{{route('blog.show',$data->slug)}}"> {{str_limit($data->title,80)}} - @foreach($data->categorys->random(1) as $cat)<span>{{$cat->name}}</span>@endforeach</a></li>

                                  @endforeach
                                </ul>
                                <div class="bn-navi">
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <ul class="pull-right">
                          @php
                            $todaydate = Carbon\Carbon::now()->format('d F Y');
                          @endphp
                            <li> <i class="ti-calendar"></i> {{$todaydate}}</li>
                            <!-- <li>
                                <a href="#"> <i class="ti-user"></i> login</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @yield('top-small-post-slider')
    <section class="menu-container-section">
        <nav id="menu-3" class="megaMenu" data-color="">
            <div class="nav-container">
                <div class="sticky-container">
                    <!-- mobile trigger button for show the collapse drop down -->
                    <ul class="menu-mobile-trigger">
                        <li><i class="fa fa-bars"></i></li>
                    </ul>
                    <ul class="menu-logo hidden-md">
                        <li>
                            <a href="{{route('index')}}">
                                <img src="{{$logo->logo}}" class="img-responsive" alt="logo">
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-search-bar-mobile">
                        <li>
                            <form action="#">
                                <button type="submit"><i class="fa fa-search"></i></button>
                                <input type="search" name="s" placeholder="Search...">
                            </form>
                        </li>
                    </ul>
                    <ul class="menu-links pull-right">
                        <li class="{{Route::currentRouteName() == 'index'?'active':''}}">
                            <a href="{{route('index')}}">
                                <span class="text">  Home </span>
                            </a>
                        </li>
                        @foreach($category->take(6) as $data)
                        <li class="{{url()->current() == route('category.posts',$data->slug) ?'active':''}}">
                            <a href="{{route('category.posts',$data->slug)}}"><span class="text"> {{$data->name}} </span> </a>
                        </li>
                        @endforeach
                        <li>
                            <a href="{{route('contact')}}">
                                <span class="text"> Contact</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>


    @yield('content')

    <footer class="footer-white">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12 no-padding">
                        <h2>About Us</h2>
                        <div class="footer-block">
                            <p style="margin-top:0px;">{{$contact->short_about}}</p>
                            <div class="footer-detail">
                                <ul class="personal-info">
                                    <li><i class="fa fa-map-marker"></i> {{$contact->address}}</li>
                                    <li><i class="fa fa-envelope"></i> {{$contact->email}} </li>
                                </ul>
                            </div>
                            <div class="social-media-icons">
                                <ul>
                                    <li> <a href="{{$contact->facebook}}"><i style="padding:0px; margin-right:16px;" class="ti-facebook"></i></a></li>
                                    <li> <a href="{{$contact->twitter}}"><i style="padding:0px; margin-right:16px;" class="ti-twitter"></i></a></li>
                                    <li> <a href="{{$contact->instagram}}"><i style="padding:0px; margin-right:16px;" class="ti-instagram"></i></a></li>
                                    <li> <a href="{{$contact->linkedin}}"><i style="padding:0px; margin-right:16px;" class="ti-linkedin"></i></a></li>
                                    <li> <a href="{{$contact->google}}"><i style="padding:0px; margin-right:16px;" class="ti-google"></i></a></li>
                                    <li> <a href="{{$contact->pinterest}}"><i style="padding:0px; margin-right:16px;" class="ti-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 col-sm-6 ">
                        <h2>Most Recent Tags</h2>
                        <div class="tag-list">@foreach($tags->take(15) as $tag) <a href="{{route('tag.posts',$tag->slug)}}">{{$tag->name}}</a>  @endforeach</div>
                    </div>
                    <div class="col-xs-12 col-md-4 col-sm-6 ">
                        <h2>Most Read Articles</h2>
                        <ul class="tabs-posts">
                          @foreach($mostView as $data)
                            <li>
                                <div class="caption"> <a href="{{route('blog.show',$data->slug)}}">{{$data->title}}</a> </div>
                                <ul class="post-tools">
                                    <li> {{$data->publish_time}} </li>
                                    <li title="Comments"> <i class="ti-eye"></i> {{views($data)->count()}} </li>
                                </ul>
                            </li>
                          @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-link bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <ul>
                          @foreach($pages as $data)
                            <li><a href="{{route('page',$data->slug)}}"> {{$data->name}} </a></li>
                          @endforeach
                        </ul>
                        <div class="copyright"> <span>{{$contact->copyright}}</span> </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
    <!-- MOZDERNIZR JS -->
    <script src="{{asset('content/website')}}/js/modernizr.js" type="text/javascript"></script>
    <!-- Core Jquery -->
    <script src="{{asset('content/website')}}/js/jquery.min.js" type="text/javascript"></script>
    <!-- Jquery Plugin -->
    <script src="{{asset('content/website')}}/js/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- Bootstrap Core Js -->
    <script src="{{asset('content/website')}}/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Mega Menu Script -->
    <script src="{{asset('content/website')}}/js/megaMenu.min.js"></script>
    <!-- Owl Slider -->
    <script src="{{asset('content/website')}}/js/owl.carousel.min.js" type="text/javascript"></script>
    <script src="{{asset('content/website')}}/js/breakingNews.js" type="text/javascript"></script>
    <script src="{{asset('content/website')}}/js/theia-sticky-sidebar.js" type="text/javascript"></script>
    <!-- Gallery Magnify  -->
    <script src="{{asset('content/website')}}/js/jquery.magnific-popup.min.js"></script>
    <!--Style Switcher -->
    <script src="{{asset('content/website')}}/js/color-switcher.js"></script>
    <!-- Template Custom Js -->
    <script src="{{asset('content/website')}}/js/custom.js" type="text/javascript"></script>
    <!-- Body End -->
</body>



</html>
