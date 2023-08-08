<nav class="main-header navbar navbar-expand <?php echo e(config('admin.theme.navbar'), false); ?>">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>




        <?php echo Admin::getNavbar()->render('left'); ?>

    </ul>

    <!-- SEARCH FORM -->











    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <?php echo Admin::getNavbar()->render(); ?>


        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <a href="<?php echo e(admin_url('auth/logout'), false); ?>" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i> <?php echo e(admin_trans('admin.logout'), false); ?>

                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo e(admin_url('auth/setting'), false); ?>" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> <?php echo e(admin_trans('admin.setting'), false); ?>

                </a>
            </div>
        </li>





    </ul>
</nav>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/partials/header.blade.php ENDPATH**/ ?>