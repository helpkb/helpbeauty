@extends('blog.layouts.master', [
  'title' => $post->title,
  'meta_description' => $post->meta_description ?: config('blog.description'),
])

@section('page-header')
    <header class="intro-header"
            style="background-image: url('{{ page_image($post->page_image) }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>

            <span class="meta">
                @if ($post->tags->count())
                    in
                    {!! join(', ', $post->tagLinks()) !!}
                @endif
            </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@stop


@section('kb')
    class = "active"
@stop

@section('breadcrumb')
    <div class="site-hero clearfix">

        <ol class="breadcrumb breadcrumb-custom">
            <li class="text">Digitaal Kantoor:</li>
            <li class="active">Categorieen Index</li>
        </ol>
    </div>
@stop




@section('content')

    {{-- The Post --}}
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    {!! $post->content_html !!}
                </div>
            </div>
        </div>
    </article>

    {{-- The Pager --}}
    <div class="container">
        <div class="row">
            <ul class="pager">
                @if ($post->newerPost($tag))
                    <li class="previous">
                        <a href="{!! $post->newerPost->slug !!}">
                            <i class="fa fa-long-arrow-left fa-lg"></i>
                            Next Newer {{ $tag ? $tag->tag : '' }} Post
                        </a>
                    </li>
                @endif
                @if ($post->olderPost($tag))
                    <li class="next">
                        <a href="{!! $post->olderPost->slug !!}">
                            Next Older {{ $tag ? $tag->tag : '' }} Post
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

    </div>
@stop
