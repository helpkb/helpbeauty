<header id="masthead" class="site-header" role="banner">
    <div class="container" style="">
        <div id="logo" class="site-logo text-center" style="font-size: 30px;">
            Digitaal Kantoor Help
        </div><!-- #logo -->
        <div id="navbar" class="navbar-wrapper text-center">
            <nav class="navbar navbar-default site-navigation" role="navigation">
                <ul class="nav navbar-nav navbar-menu">
                    <li @yield('home')><a href="{{url('/')}}">DK Help</a></li>
                    <li><a href="{{route('category-list')}}">Categorieen</a></li>
                    <li><a href="{{route('article-list')}}">Veel gestelde Vragen</a></li>
                </ul><!-- .navbar-user -->

            </nav><!-- #site-navigation -->
        </div><!-- #navbar -->
    </div>
</header>
