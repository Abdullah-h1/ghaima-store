<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale'), false); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">
    <title><?php echo e(Admin::title(), false); ?> <?php if($header): ?> | <?php echo e($header, false); ?><?php endif; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php if(!is_null($favicon = Admin::favicon())): ?>
    <link rel="shortcut icon" href="<?php echo e($favicon, false); ?>">
    <?php endif; ?>

    <script src="<?php echo e(admin_asset('vendor/laravel-admin/require.js'), false); ?>"></script>
    <script src="<?php echo e(admin_route('require-config'), false); ?>"></script>
    
</head>

<body class="hold-transition <?php echo e(join(' ', config('admin.theme.layout')), false); ?> <?php echo e(config('admin.theme.accent') ? 'accent-'.config('admin.theme.accent') : '', false); ?>">

<?php if($alert = config('admin.top_alert')): ?>
    <div style="text-align: center;padding: 5px;font-size: 12px;background-color: #ffffd5;color: #ff0000;">
        <?php echo $alert; ?>

    </div>
<?php endif; ?>


<div class="wrapper">
    <?php echo $__env->make('admin::partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin::partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-wrapper" id="pjax-container">
        <?php echo Admin::style(); ?>

        <?php echo $__env->yieldContent('content'); ?>
        <?php echo Admin::html(); ?>

        <?php echo Admin::script(); ?>

    </div>
    <?php echo $__env->make('admin::partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

</body>
</html>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/index.blade.php ENDPATH**/ ?>