<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>User Name</p>
            </div>
        </div>

<!--


                $item->item(trans('blog::post.title.post'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.blog.post.create');
                    $item->route('admin.blog.post.index');
                    $item->authorize(
                        $this->auth->hasAccess('blog.posts.index')
                    );
                });
                $item->item(trans('blog::tag.title.tag'), function (Item $item) {
                    $item->icon('fa fa-tags');
                    $item->weight(0);
                    $item->append('admin.blog.tag.create');
                    $item->route('admin.blog.tag.index');
                    $item->authorize(
                        $this->auth->hasAccess('blog.tags.index')
                    );
                });
                $item->item(trans('blog::category.title.category'), function (Item $item) {
                    $item->icon('fa fa-file-text');
                    $item->weight(1);
                    $item->route('admin.blog.category.index');
                    $item->append('admin.blog.category.create');
                    $item->authorize(
                        $this->auth->hasAccess('blog.categories.index')
                    );
                });

-->
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->

            <li class="treeview">
                <a href="#"><span>Modules</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li @if (Request::is('admin/categories*')) class="active" @endif> <a href="{{ URL::route('admin.post.index') }}">List Modules</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><span>Veel gestelde vragen</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li @if (Request::is('admin/posts*')) class="active" @endif> <a href="{{ URL::route('admin.post.index') }}">List Veel gestelde vragen</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><span>Tags</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li @if (Request::is('admin/tags*')) class="active" @endif> <a href="{{ URL::route('admin.tag.index') }}">List Tags</a></li>
                </ul>
            </li>


        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>