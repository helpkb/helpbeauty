@extends('admin.layouts.admin_template')

@section('content')

    <h1>Editing {{ $category->name }}</h1>

    <hr>

            @include('admin.partials.errors')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif

    {!! Form::model($category, [
        'method' => 'PUT',
        'route' => ['admin.category.update', $category->id]
    ]) !!}



<div class="col-md-8">
    <div class="form-group">
        {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('slug', 'Slug:', ['class' => 'control-label']) !!}
        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Update Category', ['class' => 'btn btn-primary']) !!}


              </div>

    {!! Form::close() !!}

@stop

@section('scripts')
@stop
