<style>
    .main-sidebar {
        max-height: 102vh !important;
        min-height: 102vh !important;
        position: fixed;
        overflow-x: scroll;
    }
</style>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        {!! Menu::render('admin-sidebar-menu', 'adminltecustom') !!}
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
