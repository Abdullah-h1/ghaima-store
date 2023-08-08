<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e(config('admin.title'), false); ?> | <?php echo e(admin_trans('admin.login'), false); ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php if(!is_null($favicon = Admin::favicon())): ?>
        <link rel="shortcut icon" href="<?php echo e($favicon, false); ?>">
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(admin_asset("vendor/laravel-admin/fontawesome-free/css/all.min.css"), false); ?>">
    <link rel="stylesheet" href="<?php echo e(admin_asset("vendor/laravel-admin/icheck-bootstrap/icheck-bootstrap.min.css"), false); ?>">
    <link rel="stylesheet" href="<?php echo e(admin_asset("vendor/laravel-admin/AdminLTE/css/adminlte.min.css"), false); ?>">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    <script src="<?php echo e(admin_asset("vendor/laravel-admin/jquery/jquery.min.js"), false); ?>"></script>
</head>
<body class="text-sm row vh-100 overflow-hidden">

    <div class="col" <?php echo admin_login_page_backgroud(); ?>></div>

    <div class="col d-flex justify-content-center align-items-center bg-light">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo e(admin_url('/'), false); ?>"><b><?php echo e(config('admin.name'), false); ?></b></a>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg"><?php echo e(admin_trans('admin.login'), false); ?></p>

                    <form action="<?php echo e(admin_url('auth/login'), false); ?>" method="post">
                        <div class="form-group">
                            <?php if($errors->has('username')): ?>
                                <?php $__currentLoopData = $errors->get('username'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="col-form-label text-danger">
                                        <i class="fa fa-times-circle-o"></i><?php echo e($message, false); ?>

                                    </label><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control " placeholder="<?php echo e(admin_trans('admin.username'), false); ?>"
                                       name="username" value="<?php echo e(old('username'), false); ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php if($errors->has('password')): ?>
                                <?php $__currentLoopData = $errors->get('password'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="col-form-label text-danger">
                                        <i class="fa fa-times-circle-o"></i><?php echo e($message, false); ?>

                                    </label>
                                    <br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="<?php echo e(admin_trans('admin.password'), false); ?>"
                                       name="password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-<?php echo "info";?>">
                                    <input type="checkbox" id="remember" name="remember"
                                           value="1" <?php echo e((!old('username') || old('remember')) ? 'checked' : '', false); ?>>
                                    <label for="remember">
                                        <?php echo e(admin_trans('admin.remember_me'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <?php echo e(csrf_field(), false); ?>

                                <button type="submit" class="btn btn-<?php echo "info";?> btn-block">
                                    <?php echo e(admin_trans('admin.login'), false); ?>

                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
    </div>
    <script type="text/javascript">
        $(function () {
            $('form input[name=username]').focus();
        });
    </script>
</body>
</html>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/login.blade.php ENDPATH**/ ?>