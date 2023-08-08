<div class="card card-outline card-<?php echo e($style, false); ?>">
    <div class="card-header">
        <h3 class="card-title"><?php echo e($title, false); ?></h3>
        <div class="card-tools">
            <?php echo $tools; ?>

        </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="form-horizontal">

        <div class="card-body">

            <div class="fields-group">

                <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $field->render(); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
</div>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/show/panel.blade.php ENDPATH**/ ?>