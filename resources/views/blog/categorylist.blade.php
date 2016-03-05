@extends('blog.layouts.master', [
  'title' => 'Categorieen',
  'meta_description' => 'Alle Categorieen voor Digitaal Kantoor',
])

@section('title')
    Category List -
@stop

@section('page-header')
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-5 col-md-10 col-md-offset-3">
                    <div class="post-heading">
                        <h2 style="color:#330000">Categorieen</h2>
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
    {{-- The Categories --}}
    <div id="content" class="site-content col-md-8 col-md-offset-2">
        <!-- Start of Page Container -->

        <div class="row separator">
            @foreach($categories as $category)
                <div class="col-md-6">
                    {{-- get the article_id where category_id == current category --}}
                    <section class="articles-list col-lg-10 col-lg-offset-1 col-md-10">
                        <?php
                        $categoryIds = $category->getImmediateDescendants(array('id'))->pluck('id');
                        $countmyposts = $category->countAllPostsfromSubCat($categoryIds);
                        $allmypostcategories = $category->getAllPostsfromSubCat($categoryIds);
                        ?>
                        <h3><i class="fa-fw text-muted"></i> <a href="{{url('category-list/'.$category->slug)}}">{{$category->name}}</a><span>({{$countmyposts}})</span></h3>
                        <ul class="result-list">
                        @foreach($allmypostcategories as $arti)
                            <li style="margin-left: 5px;">
                                <h4><a href="{{url('show/'.$arti->slug)}}">{{$arti->title}}</a> <span class="smalltext">{{$arti->name}}</span></h4>
                            </li>
                        @endforeach
                            <li><a href="{{url('category-list/'.$category->slug)}}"><span class="smalltext">Bekijk alle <span>{{$countmyposts}}</span> vragen</span></a></li>
                        </ul>
                    </section>
                </div>
            @endforeach

        </div>
    </div>
    <!-- end of page content -->

@stop

