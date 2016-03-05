<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> @yield('title') {!! strip_tags($title_name) !!} </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> --}}
    <link href="{{asset("lb-faveo/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("lb-faveo/css/AdminLTEsemi.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    {{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> --}}
    <link href="{{asset("lb-faveo/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    {{-- <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" /> --}}
    <link href="{{asset("lb-faveo/css/ionicons.min.css")}}" rel="stylesheet" type="text/css"/>
    <!-- fullCalendar 2.2.5-->
    <link href="{{asset("lb-faveo/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <!-- Theme style -->
    <link href="{{asset("lb-faveo/dist/css/jquery.rating.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("lb-faveo/css/app.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("lb-faveo/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}" rel="stylesheet"
          type="text/css"/>

    {{-- // <script src="ckeditor/ckeditor.js"></script> --}}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    {{-- // <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    @yield('HeadInclude')
</head>
<body>
<div id="page" class="hfeed site">
    <header id="masthead" class="site-header" role="banner">
        <div class="container" style="">
            <div id="logo" class="site-logo text-center" style="font-size: 30px;">
                Themes default1 client layout client (1)
            </div><!-- #logo -->
            <div id="navbar" class="navbar-wrapper text-center">
                <nav class="navbar navbar-default site-navigation" role="navigation">
                    <ul class="nav navbar-nav navbar-menu">
                        <li @yield('home')><a href="{{url('/')}}">{!! Lang::get('lang.home') !!}</a></li>
                        <li @yield('kb')><a
                                    href="{!! url('knowledgebase') !!}">{!! Lang::get('lang.knowledge_base') !!}</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('category-list')}}">{!! Lang::get('lang.categories') !!}</a></li>
                                <li><a href="{{route('article-list')}}">{!! Lang::get('lang.articles') !!}</a></li>
                            </ul>
                        </li>
                        @if(Auth::user())
                            <li @yield('myticket')><a
                                        href="{{url('mytickets')}}">{!! Lang::get('lang.my_tickets') !!}</a></li>
                            <li @yield('myticket')><a
                                        href="{{url('/admin/dashboard')}}">{!! "dashboard" !!}</a></li>
                            {{-- <li @yield('contact')><a href="{{route('contact')}}">Contact us</a></li> --}}
                    </ul><!-- .navbar-user -->
                    @endif
                </nav><!-- #site-navigation -->
            </div><!-- #navbar -->

            <div id="header-search" class="site-search clearfix" style="padding-bottom:5px"><!-- #header-search -->
                {!!Form::open(['method'=>'get','action'=>'Client\kb\UserController@search','class'=>'search-form clearfix'])!!}
                <div class="form-border">

                    <div class="form-inline ">
                        <div class="form-group">
                            <input type="text" name="s" class="search-field form-control input-lg"
                                   title="Enter search term"
                                   placeholder="{!! Lang::get('lang.have_a_question?_type_your_search_term_here') !!}"/>
                        </div>
                        <button type="submit"
                                class="search-submit btn btn-custom btn-lg pull-right">{!! Lang::get('lang.search') !!}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <!-- Right side column. Contains the navbar and content of the page -->
    @yield('breadcrumb')
            <!-- Main content -->
    <div id="main" class="site-main clearfix">
        <div class="container">
            <div class="content-area">
                <div class="row">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <i class="fa  fa-check-circle"></i>
                            <b>Success!</b>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{Session::get('success')}}
                        </div>
                        @endif
                                <!-- failure message -->
                        @if(Session::has('fails'))
                            <div class="alert alert-danger alert-dismissable">
                                <i class="fa fa-ban"></i>
                                <b>Alert!</b> Failed.
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                {{Session::get('fails')}}
                            </div>
                        @endif

                        @yield('content')
                        <div id="sidebar" class="site-sidebar col-md-3">
                            <div class="widget-area">
                                <section id="section-banner" class="section">
                                    @yield('check')
                                </section><!-- #section-banner -->
                                <section id="section-categories" class="section">
                                    @yield('category')
                                </section><!-- #section-categories -->
                            </div>
                        </div><!-- #sidebar -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <?php
    $footer1 = App\Model\helpdesk\Theme\Widgets::where('name', '=', 'footer1')->first();
    $footer2 = App\Model\helpdesk\Theme\Widgets::where('name', '=', 'footer2')->first();
    $footer3 = App\Model\helpdesk\Theme\Widgets::where('name', '=', 'footer3')->first();
    $footer4 = App\Model\helpdesk\Theme\Widgets::where('name', '=', 'footer4')->first();
    ?>
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
            <div class="row col-md-12">
                @if($footer1->title == null)
                @else
                    <div class="col-md-3">
                        <div class="widget-area">
                            <section id="section-about" class="section">
                                <h2 class="section-title h4 clearfix">{!!$footer1->title!!}</h2>

                                <div class="textwidget">
                                    <p>{!!$footer1->value!!}</p>
                                </div>
                            </section><!-- #section-about -->
                        </div>
                    </div>
                @endif
                @if($footer2->title == null)
                @else
                    <div class="col-md-3">
                        <div class="widget-area">
                            <section id="section-latest-news" class="section">
                                <h2 class="section-title h4 clearfix">{!!$footer2->title!!}</h2>

                                <div class="textwidget">
                                    <p>{!! $footer2->value !!}</p>
                                </div>
                            </section><!-- #section-latest-news -->
                        </div>
                    </div>
                @endif
                @if($footer3->title == null)
                @else
                    <div class="col-md-3">
                        <div class="widget-area">
                            <section id="section-newsletter" class="section">
                                <h2 class="section-title h4 clearfix">{!!$footer3->title!!}</h2>

                                <div class="textwidget">
                                    <p>{!! $footer3->value !!}</p>
                                </div>
                            </section><!-- #section-newsletter -->
                        </div>
                    </div>
                @endif
                @if($footer4->title == null)
                @else
                    <div class="col-md-3">
                        <div class="widget-area">
                            <section id="section-newsletter" class="section">
                                <h2 class="section-title h4 clearfix">{{$footer4->title}}</h2>

                                <div class="textwidget">
                                    <p>{!! $footer4->value !!}</p>
                                </div>
                            </section>
                        </div>
                    </div>
                @endif
            </div>
            <div class="clearfix"></div>
            <hr/>
            <div class="row">
                <div class="site-info col-md-6">
                    <p class="text-muted">{!! Lang::get('lang.copyright') !!} &copy; {!! date('Y') !!} <a
                                href="#">company name</a>. {!! Lang::get('lang.all_rights_reserved') !!}
                        . {!! Lang::get('lang.powered_by') !!} <a href="http://www.faveohelpdesk.com/" target="_blank">Faveo</a>
                    </p>
                </div>
                <div class="site-social text-right col-md-6">
                    <?php $socials = App\Model\helpdesk\Theme\Widgets::all(); ?>
                    <ul class="list-inline hidden-print">
                        @foreach($socials as $social)
                            @if($social->name == 'facebook')
                                @if($social->value)
                                    <li><a href="{!! $social->value !!}" class="btn btn-social btn-facebook"><i
                                                    class="fa fa-facebook fa-fw"></i></a></li>
                                @endif
                            @endif
                            @if($social->name == "twitter")
                                @if($social->value)
                                    <li><a href="{{ $social->value }}" class="btn btn-social btn-twitter"><i
                                                    class="fa fa-twitter fa-fw"></i></a></li>
                                @endif
                            @endif
                            @if($social->name == "google")
                                @if($social->value)
                                    <li><a href="{{$social->value}}" class="btn btn-social btn-google-plus"><i
                                                    class="fa fa-google-plus fa-fw"></i></a></li>
                                @endif
                            @endif
                            @if($social->name == "linkedin")
                                @if($social->value)
                                    <li><a href="{{$social->value}}" class="btn btn-social btn-linkedin"><i
                                                    class="fa fa-linkedin fa-fw"></i></a></li>
                                @endif
                            @endif
                            @if($social->name == "vimeo")
                                @if($social->value)
                                    <li><a href="{{$social->value}}" class="btn btn-social btn-vimeo"><i
                                                    class="fa fa-vimeo-square fa-fw"></i></a></li>
                                @endif
                            @endif
                            @if($social->name == "youtube")
                                @if($social->value)
                                    <li><a href="{{$social->vlaue}}" class="btn btn-social btn-youtube"><i
                                                    class="fa fa-youtube-play fa-fw"></i></a></li>
                                @endif
                            @endif
                            @if($social->name == "pinterest")
                                @if($social->value)
                                    <li><a href="{{$social->value}}" class="btn btn-social btn-pinterest"><i
                                                    class="fa fa-pinterest fa-fw"></i></a></li>
                                @endif
                            @endif
                            @if($social->name == "dribbble")
                                @if($social->value)
                                    <li><a href="{{$social->value}}" class="btn btn-social btn-dribbble"><i
                                                    class="fa fa-dribbble fa-fw"></i></a></li>
                                @endif
                            @endif
                            @if($social->name == "flickr")
                                @if($social->value)
                                    <li><a href="{{$social->value}}" class="btn btn-social btn-flickr"><i
                                                    class="fa fa-flickr fa-fw"></i></a></li>
                                @endif
                            @endif
                            @if($social->name == "instagram")
                                @if($social->value)
                                    <li><a href="{{$social->value }}" class="btn btn-social btn-instagram"><i
                                                    class="fa fa-instagram fa-fw"></i></a></li>
                                @endif
                            @endif
                            @if($social->name == "rss")
                                @if($social->value)
                                    <li><a href="{{$social->rss}}" class="btn btn-social btn-rss"><i
                                                    class="fa fa-rss fa-fw"></i></a></li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
    </footer><!-- #colophon -->
    <!-- jQuery 2.1.3 -->
    {{-- // <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    <script src="{{asset("lb-faveo/js/jquery2.1.1.min.js")}}" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    {{-- // <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script> --}}
    <script src="{{asset("lb-faveo/js/bootstrap.min.js")}}" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="{{asset("lb-faveo/js/superfish.js")}}" type="text/javascript"></script>
    <script src="{{asset("lb-faveo/js/mobilemenu.js")}}" type="text/javascript"></script>
    <script src="{{asset("lb-faveo/js/know.js")}}" type="text/javascript"></script>
    <script src="{{asset("lb-faveo/dist/js/jquery.rating.pack.js")}}" type="text/javascript"></script>
    <script src="{{asset("lb-faveo/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}"
            type="text/javascript"></script>
    <script src="{{asset("lb-faveo/plugins/iCheck/icheck.min.js")}}" type="text/javascript"></script>
    <script>
        $(function () {

            //Enable check and uncheck all functionality
            $(".checkbox-toggle").click(function () {
                var clicks = $(this).data('clicks');
                if (clicks) {
                    //Uncheck all checkboxes
                    $("input[type='checkbox']", ".mailbox-messages").iCheck("uncheck");
                } else {
                    //Check all checkboxes
                    $("input[type='checkbox']", ".mailbox-messages").iCheck("check");
                }
                $(this).data("clicks", !clicks);
            });

            //Handle starring for glyphicon and font awesome
            $(".mailbox-star").click(function (e) {
                e.preventDefault();
                //detect type
                var $this = $(this).find("a > i");
                var glyph = $this.hasClass("glyphicon");
                var fa = $this.hasClass("fa");

                //Switch states
                if (glyph) {
                    $this.toggleClass("glyphicon-star");
                    $this.toggleClass("glyphicon-star-empty");
                }

                if (fa) {
                    $this.toggleClass("fa-star");
                    $this.toggleClass("fa-star-o");
                }
            });
        });
    </script>
</body>
</html>