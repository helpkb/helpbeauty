@extends('admin.layouts.admin_template')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>Categories
                    <small>&raquo; Listing</small>
                </h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/category/create" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> New Category
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('admin.partials.errors')
                @include('admin.partials.success')

                <table id="categories-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Published</th>
                        <th data-sortable="false">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td data-order="{{ $category->slug }}">
                                {{ $category->slug }}
                            </td>
                            <td>
                                <a href="/admin/category/{{ $category->id }}/edit"
                                   class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="{{ $category->slug }}"
                                   class="btn btn-xs btn-warning">
                                    <i class="fa fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Published</th>
                        <th data-sortable="false">Actions</th>
                    </tr>
                    </tfoot>
                </table>
            <!-- /.box-body -->
            </div>
        <!-- /.box -->

    </div>
@stop

@section('scripts')
    <script>
        $(function () {
            $("#categories-table").DataTable({
                order: [[0, "desc"]],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            });
        });
    </script>
@stop