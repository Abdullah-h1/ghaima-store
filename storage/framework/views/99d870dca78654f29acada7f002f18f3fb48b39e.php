<aside class="main-sidebar elevation-4 sidebar-<?php echo e(config('admin.theme.sidebar'), false); ?>">

    <a href="<?php echo e(admin_url('/'), false); ?>" class="brand-link <?php echo e(config('admin.theme.logo') ? 'navbar-'.config('admin.theme.logo') : '', false); ?>">
        <img src="<?php echo config('admin.logo.image'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo config('admin.logo.text', config('admin.name')); ?></span>
    </a>

    <!-- sidebar: style can be found in sidebar.less -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo e(Admin::user()->avatar, false); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo e(Admin::user()->name, false); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php echo $__env->renderEach('admin::partials.menu', Admin::menu(), 'item'); ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/partials/sidebar.blade.php ENDPATH**/ ?>