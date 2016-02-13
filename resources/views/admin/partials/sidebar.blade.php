<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->

            <li class="treeview">
                <a href="#"><span>Categorie&euml;n</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li @if (Request::is('admin/category*')) class="active" @endif> <a href="{{ URL::route('admin.category.index') }}">List Categorie&euml;n</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><span>Veel gestelde vragen</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li @if (Request::is('admin/post*')) class="active" @endif> <a href="{{ URL::route('admin.post.index') }}">List Veel gestelde vragen</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><span>Pagina's</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li @if (Request::is('admin/page*')) class="active" @endif> <a href="{{ URL::route('admin.page.index') }}">List Pagina's</a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#"><span>Tags</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li @if (Request::is('admin/tag*')) class="active" @endif> <a href="{{ URL::route('admin.tag.index') }}">List Tags</a></li>
                </ul>
            </li>


        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>