@extends('blog.layouts.master', [
  'title' => $post->title,
  'meta_description' => $post->meta_description ?: config('blog.description'),
])

@section('page-header')
                        <h1>{{ $post->title }}</h1>

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

                    {!! $post->content_html !!}

@stop
