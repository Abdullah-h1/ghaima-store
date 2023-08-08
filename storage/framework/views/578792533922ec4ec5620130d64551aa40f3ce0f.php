<style>
    .ext-icon {
        color: rgba(0,0,0,0.5);
        margin-left: 10px;
    }
    .installed {
        color: #00a65a;
        margin-right: 10px;
    }
</style>
<div class="card card-<?php echo "info";?> card-outline">
    <div class="card-header">
        <h3 class="card-title">Available extensions</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <ul class="products-list product-list-in-card">

            <?php $__currentLoopData = $extensions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="item">
                <div class="product-img">
                    <i class="<?php echo e($extension['icon'], false); ?> fa-2x ext-icon"></i>
                </div>
                <div class="product-info">
                    <a href="<?php echo e($extension['link'], false); ?>" target="_blank" class="product-title">
                        <?php echo e($extension['name'], false); ?>

                    </a>
                    <?php if($extension['installed']): ?>
                        <span class="float-right installed"><i class="fa fa-check"></i></span>
                    <?php endif; ?>
                </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!-- /.item -->
        </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-footer text-center">
        <a href="https://github.com/laravel-admin-extensions" target="_blank" class="uppercase">View All Extensions</a>
    </div>
    <!-- /.card-footer -->
</div>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/dashboard/extensions.blade.php ENDPATH**/ ?>