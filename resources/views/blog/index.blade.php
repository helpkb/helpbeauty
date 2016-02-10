@extends('blog.layouts.master')

@section('page-header')

    <header class="intro-header"
            style="background-image: url('http://chuckheintzelman.com.s3-us-west-2.amazonaws.com/l5beauty/web-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>All Veel gestelde Vragen</h1>
                        <hr class="small">
                        <h2 class="subheading">Learn Laravel 5 step-by-step in my new book</h2>
                    </div>
                </div>
            </div>
        </div>
    </header>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

                {{-- The Posts --}}
                @if ( !$posts->count() )
                    There is no post till now. Login and write a new post now!!!
                @else
                    @foreach ($posts as $post)
                        <div class="post-preview">
                            <a href="{{ $post->slug }}">
                                <h2 class="post-title">{{ $post->title }}</h2>
                            </a>

                            <p class="post-meta">
                                Posted on {{ $post->published_at->format('F j, Y') }}
                                @if ($post->tags->count())
                                    in
                                    {!! join(', ', $post->tagLinks()) !!}
                                @endif
                            </p>
                        </div>
                        <hr>
                    @endforeach
                @endif

                {{-- The Pager --}}
                <ul class="pager">
                    @if ($posts->currentPage() > 1)
                        <li class="previous">
                            <a href="{!! $posts->url($posts->currentPage() - 1) !!}">
                                <i class="fa fa-long-arrow-left fa-lg"></i>
                                Newer Posts
                            </a>
                        </li>
                    @endif
                    @if ($posts->hasMorePages())
                        <li class="next">
                            <a href="{!! $posts->nextPageUrl() !!}">
                                Older Posts
                                <i class="fa fa-long-arrow-right"></i>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>

        </div>
    </div>
@stop
