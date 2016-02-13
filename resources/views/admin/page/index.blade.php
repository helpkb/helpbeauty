@extends('admin.layouts.admin_template')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>Pages
                    <small>&raquo; Listing</small>
                </h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/page/create" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> New Page
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('admin.partials.errors')
                @include('admin.partials.success')

                <table id="pages-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th data-sortable="false">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>
                                <a href="/admin/page/{{ $page->id }}/edit"
                                   class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="{{ $page->slug }}"
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
                        <th>Slug</th>
                        <th data-sortable="false">Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
@stop

@section('scripts')
    <script>
        $(function () {
            $("#pages-table").DataTable({
                order: [[0, "desc"]],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            });
        });
    </script>
@stop